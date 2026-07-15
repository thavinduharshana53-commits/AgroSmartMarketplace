<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManageOffersController extends Controller
{
    public function index()
    {
        $offers = Offer::with(['buyer', 'product'])
            ->whereHas('product', function ($query) {
                $query->where('farmer_id', Auth::id());
            })
            ->latest()
            ->get();

        return view('farmer.manageOffers', compact('offers'));
    }

    public function accept(Offer $offer, OrderService $orderService)
    {
        return DB::transaction(function () use ($offer, $orderService) {

            // Lock the selected offer during the transaction
            $selectedOffer = Offer::where('offer_id', $offer->offer_id)
                ->lockForUpdate()
                ->firstOrFail();

            // Lock the product to prevent two offers being accepted together
            $product = Product::where(
                    'product_id',
                    $selectedOffer->product_id
                )
                ->lockForUpdate()
                ->firstOrFail();

            // Farmer can only manage offers for their own products
            abort_unless(
                (int) $product->farmer_id === (int) Auth::id(),
                403,
                'You are not authorized to manage this offer.'
            );

            // Only pending offers can be accepted directly by the farmer
            if (strtolower($selectedOffer->status) !== 'pending') {
                return back()->with(
                    'error',
                    'This offer is no longer available.'
                );
            }

            // Check whether another offer has already been accepted
            $acceptedOfferExists = Offer::where(
                    'product_id',
                    $product->product_id
                )
                ->where('status', 'accepted')
                ->where('offer_id', '!=', $selectedOffer->offer_id)
                ->exists();

            if (
                $acceptedOfferExists ||
                strtolower($product->availability_status) !== 'available'
            ) {
                return back()->with(
                    'error',
                    'Another offer has already been accepted for this product.'
                );
            }

            // Accept the selected offer
            $selectedOffer->update([
                'status' => 'accepted',
                'accepted_by' => 'farmer',
                'rejected_by' => null,
            ]);

            $orderService->createFromAcceptedOffer($selectedOffer);

            // Automatically reject all other active offers
            Offer::where('product_id', $product->product_id)
                ->where('offer_id', '!=', $selectedOffer->offer_id)
                ->whereIn('status', ['pending', 'countered'])
                ->update([
                    'status' => 'rejected',
                    'rejected_by' => 'system',
                    'accepted_by' => null,
                    'updated_at' => now(),
                ]);

            // Make the product unavailable
            $product->update([
                'availability_status' => 'Reserved',
            ]);

            return back()->with(
                'success',
                'Offer accepted successfully. Other offers were automatically rejected.'
            );
        });
    }

    public function reject(Offer $offer)
    {
        $product = $offer->product;

        // Farmer can only manage offers for their own products
        abort_unless(
            (int) $product->farmer_id === (int) Auth::id(),
            403,
            'You are not authorized to manage this offer.'
        );

        // Only pending offers can be rejected by the farmer
        if (strtolower($offer->status) !== 'pending') {
            return back()->with(
                'error',
                'This offer is no longer available.'
            );
        }

        $offer->update([
            'status' => 'rejected',
            'rejected_by' => 'farmer',
            'accepted_by' => null,
        ]);

        return back()->with('success', 'Offer rejected successfully!'
        );
    }
}
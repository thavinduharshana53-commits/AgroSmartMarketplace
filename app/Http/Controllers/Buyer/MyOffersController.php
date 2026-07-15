<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;

class MyOffersController extends Controller
{
    public function index(){
        $offers = Offer::with([
                'product.farmer',
            ])
            ->where('buyer_id', Auth::id())
            ->latest()
            ->get();

        return view('buyer.myOffers', compact('offers'));
    }

    public  function counterReject(Offer $offer){
        // Buyer can only update their own offer.
        abort_unless(
            (int) $offer->buyer_id === (int) Auth::id(),
            403,
            'You are not authorized to manage this offer.'
        );

        // Only countered offers can be rejected.
        if (strtolower($offer->status) !== 'countered') {
            return redirect()
                ->route('buyer.myOffers')
                ->with('error', 'This counter offer is no longer available.');
        }

        $offer->update([
            'status' => 'rejected',
            'rejected_by' => 'buyer',
            'accepted_by' => null,
        ]);


        return redirect()
             ->route('buyer.myOffers')
             ->with('success', 'counter offer rejected successfully.');
    }

    public function counterAccept(Offer $offer, OrderService $orderService){

        return DB::transaction(function () use ($offer, $orderService) {

            // Lock the selected offer
            $selectedOffer = Offer::where('offer_id', $offer->offer_id)
                ->lockForUpdate()
                ->firstOrFail();

            // Buyer can only accept their own counter offer
            abort_unless(
                (int) $selectedOffer->buyer_id === (int) Auth::id(),
                403,
                'You are not authorized to manage this offer.'
            );

            // Lock the related product
            $product = Product::where(
                    'product_id',
                    $selectedOffer->product_id
                )
                ->lockForUpdate()
                ->firstOrFail();

            // Only an active counter offer can be accepted
            if (
                strtolower($selectedOffer->status) !== 'countered' ||
                $selectedOffer->counter_price === null
            ) {
                return back()->with(
                    'error',
                    'This counter offer is no longer available.'
                );
            }

            // Check whether another offer was already accepted
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

            // Accept the farmer's counter offer
            $selectedOffer->update([
                'status' => 'accepted',
                'accepted_by' => 'buyer',
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
                'Counter offer accepted successfully. Other offers were automatically rejected.'
            );
        });
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use App\Models\Demand;
use App\Services\DemandAnalysisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OfferController extends Controller
{
    public function store(Request $request, DemandAnalysisService $demandAnalysisService)
    {
        $request->validate(
            [
                'product_id' => [ 'required', 'integer', 'exists:products,product_id',

                    Rule::unique('offers', 'product_id')
                        ->where(fn ($query) =>
                            $query->where('buyer_id', Auth::id())
                        ),
                ],

                'offer_price' => ['required', 'numeric','min:0.01',],
                'note' => ['nullable', 'string', 'max:1000',],

            ],

            [
                'product_id.unique' =>
                    'You have already submitted an offer for this product.',

                'offer_price.min' =>
                    'The offered price must be greater than zero.',

            ]
        );

        $product = Product::findOrFail($request->product_id);

        if ($product->moderation_status !== 'active') {
            return back()->with('error','This product listing has been removed and is no longer available.');
        }

      // Block new offers for Reserved or Sold Out products.

        if (strtolower($product->availability_status) !== 'available') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'This product is no longer available for offers.'
                );
        }

        if ((float) $request->offer_price < (float) $product->minimum_price)
        {
            return back()
                ->withInput()
                ->withErrors([
                    'offer_price' =>
                        'Your offer must be at least Rs. ' .
                        number_format(
                            (float) $product->minimum_price,
                            2
                        ) .
                        ' per kg.',
                ]);
        }


        Offer::create([
            'product_id' => $product->product_id,
            'buyer_id' => Auth::id(),
            'offer_price' => $request->offer_price,
            'quantity' => $product->quantity,
            'note' => $request->note,
            'status' => 'pending',
            'rejected_by' => null,
            'accepted_by' => null,
        ]);

        // Record the Buyer offer activity for demand analysis.
        Demand::firstOrCreate([
            'buyer_id' => Auth::id(),
            'product_id' => $product->product_id,
            'activity_type' => 'offer',
        ],

        [
            'activity_date' => now(),
        ]);

        if ($demandActivity->wasRecentlyCreated) {
            $demandAnalysisService->analyzeProduct($product);
        }

        return redirect()
            ->back()
            ->with('success','Offer submitted successfully!');
    }
}
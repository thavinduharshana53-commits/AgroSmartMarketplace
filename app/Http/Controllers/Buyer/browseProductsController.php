<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Demand;
use App\Models\Product;
use App\Services\DemandAnalysisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class browseProductsController extends Controller
{
    public function index(Request $request, DemandAnalysisService $demandAnalysisService)
    {
        $request->validate([
            'search' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        $search = trim(
            (string) $request->query('search', '')
        );

        $products = Product::with('farmer')
            ->when(
                $search !== '',
                function ($query) use ($search) {
                    $query->where(
                        function ($productQuery) use ($search) {
                            $productQuery
                                ->where(
                                    'product_name',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'category',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'city',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'district',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhereHas(
                                    'farmer',
                                    function ($farmerQuery) use ($search) {
                                        $farmerQuery->where(
                                            'name',
                                            'like',
                                            "%{$search}%"
                                        );
                                    }
                                );
                        }
                    );
                }
            )
            ->latest()
            ->get();

        // Record search activity only when a keyword is entered.
        if ($search !== '') {
            foreach ($products as $product) {
                $alreadySearchedToday = Demand::where(
                        'buyer_id',
                        Auth::id()
                    )
                    ->where(
                        'product_id',
                        $product->product_id
                    )
                    ->where(
                        'activity_type',
                        'search'
                    )
                    ->whereDate(
                        'activity_date',
                        today()
                    )
                    ->exists();

                // One search activity per Buyer,
                // Product and day.
                if (! $alreadySearchedToday) {
                    Demand::create([
                        'buyer_id' => Auth::id(),
                        'product_id' => $product->product_id,
                        'activity_type' => 'search',
                        'activity_date' => now(),
                    ]);
                }
                  // Recalculate after recording the search.
                  $demandAnalysisService->analyzeProduct($product);
            }
        }

        return view('buyer.browseProducts', compact('products', 'search'));
    }

    public function show(Product $product, DemandAnalysisService $demandAnalysisService) {
        $product->load('farmer');

        $alreadyViewedToday = Demand::where('buyer_id', Auth::id())
            ->where('product_id', $product->product_id)
            ->where('activity_type', 'view')
            ->whereDate('activity_date', today())
            ->exists();

        if (! $alreadyViewedToday) {
            Demand::create([
                'buyer_id' => Auth::id(),
                'product_id' => $product->product_id,
                'activity_type' => 'view',
                'activity_date' => now(),
            ]);
        }


        $demandAnalysisService->analyzeProduct($product);

        return view('buyer.productDetails', compact('product'));
    }
}
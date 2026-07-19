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
    public function index(Request $request,DemandAnalysisService $demandAnalysisService)
     {
        $validated = $request->validate([
            'search' => ['nullable', 'string','max:100',],

            'district' => ['nullable','string','max:100',],

            'city' => ['nullable','string','max:100',],
        ]);

        $search = trim(
            (string) ($validated['search'] ?? '')
        );

        $district = trim(
            (string) ($validated['district'] ?? '')
        );

        $city = trim(
            (string) ($validated['city'] ?? '')
        );

        $buyer = Auth::user();

        /*
         * Get the districts available in published products.
         */
        $districts = Product::query()
            ->whereNotNull('district')
            ->where('district', '!=', '')
            ->select('district')
            ->distinct()
            ->orderBy('district')
            ->pluck('district');

        /*
         * If a district is selected, return cities belonging
         * to that district. Otherwise, return every city.
         */
        $cities = Product::query()
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->when(
                $district !== '',
                function ($query) use ($district) {
                    $query->whereRaw(
                        'LOWER(TRIM(district)) = LOWER(TRIM(?))',
                        [$district]
                    );
                }
            )
            ->select('city')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        $products = Product::with('farmer')
            ->where('moderation_status', 'active')
            /* Search by product, category, locatio or Farmer name.*/
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

            /*
             * District filter.
             */
            ->when(
                $district !== '',
                function ($query) use ($district) {
                    $query->whereRaw(
                        'LOWER(TRIM(district)) = LOWER(TRIM(?))',
                        [$district]
                    );
                }
            )

            /*
             * City filter.
             */
            ->when(
                $city !== '',
                function ($query) use ($city) {
                    $query->whereRaw(
                        'LOWER(TRIM(city)) = LOWER(TRIM(?))',
                        [$city]
                    );
                }
            )

            /*
             * When no location filter is selected,
             * prioritize products near the Buyer.
             */
            ->when(
                $district === '' && $city === '',
                function ($query) use ($buyer) {
                    $query->orderByRaw(
                        '
                        CASE
                            WHEN LOWER(TRIM(city)) = LOWER(TRIM(?))
                            THEN 1

                            WHEN LOWER(TRIM(district)) = LOWER(TRIM(?))
                            THEN 2

                            ELSE 3
                        END
                        ',
                        [
                            $buyer->city,
                            $buyer->district,
                        ]
                    );
                }
            )
            ->latest()
            ->get();

        /*
         * Record search activity only when the Buyer
         * enters a search keyword.
         *
         * District and city filtering alone will not be
         * counted as product demand.
         */
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

                if (! $alreadySearchedToday) {
                    Demand::create([
                        'buyer_id' => Auth::id(),
                        'product_id' => $product->product_id,
                        'activity_type' => 'search',
                        'activity_date' => now(),
                    ]);

                    /*
                     * Recalculate demand after recording
                     * the new search activity.
                     */
                    $demandAnalysisService->analyzeProduct(
                        $product
                    );
                }
            }
        }

        return view(
            'buyer.browseProducts',
            compact(
                'products',
                'search',
                'district',
                'city',
                'districts',
                'cities'
            )
        );
    }

    public function show(Product $product, DemandAnalysisService $demandAnalysisService)
    {
        abort_if( $product->moderation_status !== 'active',404,
            'This product listing is unavailable.'
        );

        $product->load('farmer');

        $alreadyViewedToday = Demand::where(
                'buyer_id',
                Auth::id()
            )
            ->where(
                'product_id',
                $product->product_id
            )
            ->where(
                'activity_type',
                'view'
            )
            ->whereDate(
                'activity_date',
                today()
            )
            ->exists();

        if (! $alreadyViewedToday) {
            Demand::create([
                'buyer_id' => Auth::id(),
                'product_id' => $product->product_id,
                'activity_type' => 'view',
                'activity_date' => now(),
            ]);

            $demandAnalysisService->analyzeProduct(
                $product
            );
        }

        return view(
            'buyer.productDetails',
            compact('product')
        );
    }
}
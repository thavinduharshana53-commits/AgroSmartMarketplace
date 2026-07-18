<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;

class SmartPricingService
{
    private const HIGH_DEMAND_ADJUSTMENT = 0.05;
    private const LOW_DEMAND_ADJUSTMENT = -0.05;
    private const RANGE_PERCENTAGE = 0.05;

    public function calculate(
        string $productName,
        string $category,
        string $district,
        float $minimumPrice,
        ?float $currentPrice = null,
        ?string $productDemandLevel = null
        
    ): array {
        /*
         * Completed-order price averages.
         */
        $sameProductDistrictOrderAverage =
            $this->completedOrderAverage(
                productName: $productName,
                district: $district
            );

        $sameProductOrderAverage =
            $this->completedOrderAverage(
                productName: $productName
            );

        $categoryDistrictOrderAverage =
            $this->completedOrderAverage(
                category: $category,
                district: $district
            );

        /*
         * Recent marketplace price averages.
         */
        $sameProductDistrictMarketAverage =
            $this->marketProductAverage(
                productName: $productName,
                district: $district
            );

        $sameProductMarketAverage =
            $this->marketProductAverage(
                productName: $productName
            );

        $categoryDistrictMarketAverage =
            $this->marketProductAverage(
                category: $category,
                district: $district
            );

        /*
         * Resolve demand from database activity data.
         */
        if ($productDemandLevel === null) {
            $productDemandLevel =
                $this->resolveDemandLevel(
                    productName: $productName,
                    category: $category,
                    district: $district
                );
        }

        /*
         * Select the most accurate available
         * reference price.
         */
        [$referencePrice, $dataSource] = match (true) {
            $sameProductDistrictOrderAverage !== null => [
                $sameProductDistrictOrderAverage,
                'Same product completed orders in this district',
            ],

            $sameProductOrderAverage !== null => [
                $sameProductOrderAverage,
                'Same product completed-order history',
            ],

            $categoryDistrictOrderAverage !== null => [
                $categoryDistrictOrderAverage,
                'Category completed orders in this district',
            ],

            $sameProductDistrictMarketAverage !== null => [
                $sameProductDistrictMarketAverage,
                'Same product marketplace prices in this district',
            ],

            $sameProductMarketAverage !== null => [
                $sameProductMarketAverage,
                'Same product marketplace prices',
            ],

            $categoryDistrictMarketAverage !== null => [
                $categoryDistrictMarketAverage,
                'Similar marketplace products',
            ],

            $currentPrice !== null => [
                $currentPrice,
                'Current product price',
            ],

            default => [
                $minimumPrice,
                'Farmer minimum price',
            ],
        };

        /*
         * Apply demand adjustment.
         *
         * High Demand      = +5%
         * Low Demand       = -5%
         * Insufficient Data = 0%
         */
        $adjustmentRate = match ($productDemandLevel) {
            'High Demand' =>
                self::HIGH_DEMAND_ADJUSTMENT,

            'Low Demand' =>
                self::LOW_DEMAND_ADJUSTMENT,

            default =>
                0.00,
        };

        $suggestedPrice =
            $referencePrice * (1 + $adjustmentRate);

        /*
         * Never recommend below the Farmer's
         * minimum acceptable price.
         */
        $suggestedPrice = max(
            $suggestedPrice,
            $minimumPrice
        );

        $minimumSuggestedPrice = max(
            $minimumPrice,
            $suggestedPrice *
                (1 - self::RANGE_PERCENTAGE)
        );

        $maximumSuggestedPrice =
            $suggestedPrice *
                (1 + self::RANGE_PERCENTAGE);

        return [
            'reference_price' =>
                round((float) $referencePrice, 2),

            'suggested_price' =>
                round($suggestedPrice, 2),

            'minimum_suggested_price' =>
                round($minimumSuggestedPrice, 2),

            'maximum_suggested_price' =>
                round($maximumSuggestedPrice, 2),

            'demand_level' =>
                $productDemandLevel,

            'data_source' =>
                $dataSource,
        ];
    }

    /*
     * Calculate completed-order accepted-price average.
     */
    private function completedOrderAverage(
        ?string $productName = null,
        ?string $category = null,
        ?string $district = null
    ): ?float {
        $normalizedProductName =
            $productName !== null
                ? mb_strtolower(trim($productName))
                : null;

        $average = Order::where(
                'order_status',
                'completed'
            )
            ->where(
                'created_at',
                '>=',
                now()->subDays(90)
            )
            ->whereHas(
                'product',
                function ($query) use (
                    $normalizedProductName,
                    $category,
                    $district
                ) {
                    $query
                        ->when(
                            $normalizedProductName,
                            function ($query) use (
                                $normalizedProductName
                            ) {
                                $query->whereRaw(
                                    'LOWER(TRIM(product_name)) = ?',
                                    [$normalizedProductName]
                                );
                            }
                        )
                        ->when(
                            $category,
                            function ($query) use ($category) {
                                $query->where(
                                    'category',
                                    $category
                                );
                            }
                        )
                        ->when(
                            $district,
                            function ($query) use ($district) {
                                $query->where(
                                    'district',
                                    $district
                                );
                            }
                        );
                }
            )
            ->avg('accepted_price');

        return $average !== null
            ? (float) $average
            : null;
    }

    /*
     * Calculate recent published-product price average.
     */
    private function marketProductAverage(
        ?string $productName = null,
        ?string $category = null,
        ?string $district = null
    ): ?float {
        $normalizedProductName =
            $productName !== null
                ? mb_strtolower(trim($productName))
                : null;

        $average = Product::query()
            ->where(
                'created_at',
                '>=',
                now()->subDays(90)
            )
            ->when(
                $normalizedProductName,
                function ($query) use (
                    $normalizedProductName
                ) {
                    $query->whereRaw(
                        'LOWER(TRIM(product_name)) = ?',
                        [$normalizedProductName]
                    );
                }
            )
            ->when(
                $category,
                function ($query) use ($category) {
                    $query->where(
                        'category',
                        $category
                    );
                }
            )
            ->when(
                $district,
                function ($query) use ($district) {
                    $query->where(
                        'district',
                        $district
                    );
                }
            )
            ->avg('price');

        return $average !== null
            ? (float) $average
            : null;
    }

    /*
     * Resolve demand using products that have actual
     * buyer activity during the last 30 days.
     */
    private function resolveDemandLevel(
        string $productName,
        string $category,
        string $district
    ): string {
        $normalizedProductName =
            mb_strtolower(trim($productName));

        /*
         * First check the same product
         * in the same district.
         */
        $sameProductQuery = Product::whereRaw(
                'LOWER(TRIM(product_name)) = ?',
                [$normalizedProductName]
            )
            ->where('district', $district)
            ->whereHas(
                'demand',
                function ($query) {
                    $query->where(
                        'activity_date',
                        '>=',
                        now()->subDays(30)
                    );
                }
            );

        $sameProductHighCount =
            (clone $sameProductQuery)
                ->where(
                    'demand_level',
                    'High Demand'
                )
                ->count();

        $sameProductLowCount =
            (clone $sameProductQuery)
                ->where(
                    'demand_level',
                    'Low Demand'
                )
                ->count();

        if (
            $sameProductHighCount +
            $sameProductLowCount > 0
        ) {
            return $sameProductHighCount >
                $sameProductLowCount
                    ? 'High Demand'
                    : 'Low Demand';
        }

        /*
         * If the same product has no activity,
         * check category demand in the district.
         */
        $categoryQuery = Product::where(
                'category',
                $category
            )
            ->where('district', $district)
            ->whereHas(
                'demand',
                function ($query) {
                    $query->where(
                        'activity_date',
                        '>=',
                        now()->subDays(30)
                    );
                }
            );

        $categoryHighCount =
            (clone $categoryQuery)
                ->where(
                    'demand_level',
                    'High Demand'
                )
                ->count();

        $categoryLowCount =
            (clone $categoryQuery)
                ->where(
                    'demand_level',
                    'Low Demand'
                )
                ->count();

        if (
            $categoryHighCount +
            $categoryLowCount > 0
        ) {
            return $categoryHighCount >
                $categoryLowCount
                    ? 'High Demand'
                    : 'Low Demand';
        }

        /*
         * Do not apply a demand adjustment
         * when there is no activity evidence.
         */
        return 'Insufficient Data';
    }
}
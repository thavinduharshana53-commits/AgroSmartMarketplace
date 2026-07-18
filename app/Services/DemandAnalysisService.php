<?php

namespace App\Services;

use App\Models\Demand;
use App\Models\Product;

class DemandAnalysisService
{
    private const SEARCH_POINTS = 1;
    private const VIEW_POINTS = 2;
    private const OFFER_POINTS = 3;
    private const ORDER_POINTS = 5;

    private const HIGH_DEMAND_SCORE = 10;

    public function analyzeProduct(Product $product): array
    {
        // Use activities recorded during the last 30 days.
        $activityCounts = Demand::where(
                'product_id',
                $product->product_id
            )
            ->where(
                'activity_date',
                '>=',
                now()->subDays(30)
            )
            ->selectRaw(
                'activity_type, COUNT(*) as total'
            )
            ->groupBy('activity_type')
            ->pluck(
                'total',
                'activity_type'
            );

        $searchCount = (int) ($activityCounts['search'] ?? 0);

        $viewCount = (int) ($activityCounts['view'] ?? 0);

        $offerCount = (int) ($activityCounts['offer'] ?? 0);

        $orderCount = (int) ($activityCounts['order'] ?? 0);

        $demandScore =
            ($searchCount * self::SEARCH_POINTS) +
            ($viewCount * self::VIEW_POINTS) +
            ($offerCount * self::OFFER_POINTS) +
            ($orderCount * self::ORDER_POINTS);

        $demandLevel = $demandScore >= self::HIGH_DEMAND_SCORE ? 'High Demand' : 'Low Demand';

        // Update the Product demand level automatically.
        if ($product->demand_level !== $demandLevel) {
            $product->update([
                'demand_level' => $demandLevel,
            ]);
        }

        return [
            'product_id' => $product->product_id,
            'product_name' => $product->product_name,
            'search_count' => $searchCount,
            'view_count' => $viewCount,
            'offer_count' => $offerCount,
            'order_count' => $orderCount,
            'demand_score' => $demandScore,
            'demand_level' => $demandLevel,
        ];
    }
}
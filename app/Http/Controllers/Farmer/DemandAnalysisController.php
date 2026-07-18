<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DemandAnalysisController extends Controller
{
    public function index()
    {
        $since = now()->subDays(30);

        // Logged-in Farmer's products for 30 activities.
        $products = Product::where('farmer_id', Auth::id())
            ->withCount([
                'demand as search_count' => function ($query) use ($since) {
                    $query
                        ->where('activity_type', 'search')
                        ->where('activity_date', '>=', $since);
                },

                'demand as view_count' => function ($query) use ($since) {
                    $query
                        ->where('activity_type', 'view')
                        ->where('activity_date', '>=', $since);
                },

                'demand as offer_count' => function ($query) use ($since) {
                    $query
                        ->where('activity_type', 'offer')
                        ->where('activity_date', '>=', $since);
                },

                'demand as order_count' => function ($query) use ($since) {
                    $query
                        ->where('activity_type', 'order')
                        ->where('activity_date', '>=', $since);
                },
            ])
            ->latest()
            ->get();

        // Calculate score for each product.
        $products->each(function ($product) {
            $product->demand_score =
                ($product->search_count * 1) +
                ($product->view_count * 2) +
                ($product->offer_count * 3) +
                ($product->order_count * 5);
        });

        $highDemandCount = $products
            ->where('demand_level', 'High Demand')
            ->count();

        $lowDemandCount = $products
            ->where('demand_level', 'Low Demand')
            ->count();

        $totalActivities = $products->sum(function ($product) {
            return
                $product->search_count +
                $product->view_count +
                $product->offer_count +
                $product->order_count;
        });

        $topProduct = $products
            ->sortByDesc('demand_score')
            ->first();

        return view(
            'farmer.demandAnalysis',
            compact(
                'products',
                'highDemandCount',
                'lowDemandCount',
                'totalActivities',
                'topProduct'
            )
        );
    }
}
<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $farmerId = Auth::id();

        // Total products published by the logged-in Farmer.
        $totalProducts = Product::where(
            'farmer_id',
            $farmerId
        )->count();

        // Pending offers received for the Farmer's products.
        $pendingOffers = Offer::whereHas(
            'product',
            function ($query) use ($farmerId) {
                $query->where(
                    'farmer_id',
                    $farmerId
                );
            }
        )
            ->where('status', 'pending')
            ->count();

        // Completed orders belonging to the logged-in Farmer.
        $completedOrders = Order::where(
                'farmer_id',
                $farmerId
            )
            ->where(
                'order_status',
                'completed'
            )
            ->count();

        // Review statistics.
        $totalReviews = Review::where(
            'farmer_id',
            $farmerId
        )->count();

        $averageRating = Review::where(
                'farmer_id',
                $farmerId
            )
            ->avg('rating') ?? 0;

        // Latest five Buyer reviews.
        $recentReviews = Review::with([
                'buyer',
                'product',
            ])
            ->where(
                'farmer_id',
                $farmerId
            )
            ->latest()
            ->take(5)
            ->get();

        return view('farmer.dashboard',
            compact(
                'totalProducts',
                'pendingOffers',
                'completedOrders',
                'totalReviews',
                'averageRating',
                'recentReviews'
            )
        );
    }
}
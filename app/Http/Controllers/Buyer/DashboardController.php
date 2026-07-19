<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Offer;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $buyer = Auth::user();

        $nearbyProductsCount = Product::whereRaw('LOWER(TRIM(availability_status)) = ?',['available'])
            ->where(function ($query) use ($buyer) {
                $query
                ->whereRaw('LOWER(TRIM(city)) = LOWER(TRIM(?))',[$buyer->city])
                ->orWhereRaw('LOWER(TRIM(district)) = LOWER(TRIM(?))',[$buyer->district]);
            })
            ->count();

            $activeOffers = Offer::where('buyer_id', $buyer->id)
                ->whereIn('status', ['pending','countered',])
                ->count();

            $activeOrders = Order::where('buyer_id', $buyer->id)
                ->whereIn('order_status', ['pending','confirmed','ready_for_pickup',])
                ->count();

            $completedOrders = Order::where('buyer_id', $buyer->id)
                ->where('order_status', 'completed')
                ->count();

        /*
         * Load available products near the buyer.
         *
         * Priority:
         * 1. Same city
         * 2. Same district
         */
        $products = Product::with('farmer')
            ->where('moderation_status', 'active')
            ->whereRaw(
                'LOWER(TRIM(availability_status)) = ?',
                ['available']
            )
            ->where(function ($query) use ($buyer) {
                $query
                    ->whereRaw(
                        'LOWER(TRIM(city)) = LOWER(TRIM(?))',
                        [$buyer->city]
                    )
                    ->orWhereRaw(
                        'LOWER(TRIM(district)) = LOWER(TRIM(?))',
                        [$buyer->district]
                    );
            })
            ->orderByRaw(
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
            )
            ->latest()
            ->take(6)
            ->get();

        return view('buyer.dashboard',compact(
            'buyer',
            'products',
            'nearbyProductsCount',
            'activeOffers',
            'activeOrders',
            'completedOrders'
        ));
    }
}
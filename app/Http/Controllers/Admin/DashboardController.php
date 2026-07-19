<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuyers = User::where('role', 'buyer')->count();

        $totalFarmers = User::where('role', 'farmer')->count();

        $totalProducts = Product::count();

        $completedOrders = Order::where('order_status','completed')->count();

        $recentUsers = User::whereIn('role', [
                'buyer',
                'farmer',
            ])
            ->latest()
            ->take(5)
            ->get();

        $recentProducts = Product::with('farmer')
            ->latest()
            ->take(5)
            ->get();

        return view(
            'admin.dashboard',
            compact(
                'totalBuyers',
                'totalFarmers',
                'totalProducts',
                'completedOrders',
                'recentUsers',
                'recentProducts'
            )
        );
    }
}
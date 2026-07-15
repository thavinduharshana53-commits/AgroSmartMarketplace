<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index(){

        $orders = Order::with([
                'offer',
                'product',
                'farmer',
                'review',
            ])

            ->where('buyer_id', Auth::id())
            ->latest()
            ->get();

        return view('buyer.orders',  compact('orders'));
    }
}

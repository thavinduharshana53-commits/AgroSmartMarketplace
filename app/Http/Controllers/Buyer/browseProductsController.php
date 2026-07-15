<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class browseProductsController extends Controller
{
    public function index(){
        $products = Product::with('farmer')
                    ->latest()
                    ->get();

        return view('buyer.browseProducts', compact('products'));
    }
}

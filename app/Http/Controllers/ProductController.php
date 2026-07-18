<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $imagePath = null;

        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('products', 'public');
        }

        Product::create([
            'farmer_id' => Auth::id(),
            'product_name' => $request->product_name,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'minimum_price' => $request->minimum_price,
            'district' => $request->district,
            'city' => $request->city,
            'product_image' => $imagePath,
            'description' => $request->description,
            'demand_level' => 'Low Demand',
            'availability_status' => 'Available',
        ]);

        return redirect()
            ->route('farmer.publishProducts')
            ->with('success', 'Product published successfully!');
    }
}
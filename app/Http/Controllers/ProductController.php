<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\SmartPricingService;
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

    public function suggestPrice(Request $request, SmartPricingService $smartPricingService) {

        $validated = $request->validate([
            'product_name' => [
                'required',
                'string',
                'max:255',
            ],

            'category' => [
                'required',
                'string',
                'max:100',
            ],

            'district' => [
                'required',
                'string',
                'max:100',
            ],

            'minimum_price' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'current_price' => [
                'nullable',
                'numeric',
                'min:0.01',
            ],
        ]);

        $recommendation = $smartPricingService->calculate(
            productName: $validated['product_name'],
            category: $validated['category'],
            district: $validated['district'],
            minimumPrice: (float) $validated['minimum_price'],
            currentPrice: isset($validated['current_price'])
                ? (float) $validated['current_price']
                : null,
            productDemandLevel: $validated['demand_level'] ?? null
        );

        return response()->json([
            'success' => true,
            'recommendation' => $recommendation,
        ]);
    }
}
<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyProductsController extends Controller
{
    public function index()
    {
        // Load only products published by the logged-in Farmer.
        $products = Product::where(
                'farmer_id',
                Auth::id()
            )
            ->latest()
            ->get();

        return view(
            'farmer.products.myProducts',
            compact('products')
        );
    }

    public function edit(Product $product)
    {
        // Farmer can edit only their own product.
        abort_unless(
            (int) $product->farmer_id === (int) Auth::id(),
            403,
            'You are not authorized to edit this product.'
        );

        // Only Available products can be edited.
        if (
            strtolower(trim($product->availability_status))
            !== 'available'
        ) {
            return redirect()
                ->route('farmer.products.myProducts')
                ->with(
                    'error',
                    'Reserved or sold products cannot be edited.'
                );
        }

        return view(
            'farmer.products.editProducts',
            compact('product')
        );
    }

    public function update(
        Request $request,
        Product $product
    ) {
        // Farmer can update only their own product.
        abort_unless(
            (int) $product->farmer_id === (int) Auth::id(),
            403,
            'You are not authorized to update this product.'
        );

        // Block direct update requests for Reserved or Sold Out products.
        if (
            strtolower(trim($product->availability_status))
            !== 'available'
        ) {
            return redirect()
                ->route('farmer.products.myProducts')
                ->with(
                    'error',
                    'Reserved or sold products cannot be updated.'
                );
        }

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

            'quantity' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'unit' => [
                'required',
                'string',
                'max:30',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'minimum_price' => [
                'required',
                'numeric',
                'min:0.01',
                'lte:price',
            ],

            'district' => [
                'required',
                'string',
                'max:100',
            ],

            'city' => [
                'required',
                'string',
                'max:100',
            ],

            'product_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'description' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        // Keep the existing product image by default.
        $imagePath = $product->product_image;

        // Replace image only when Farmer selects a new image.
        if ($request->hasFile('product_image')) {
            $newImagePath = $request
                ->file('product_image')
                ->store('products', 'public');

            // Delete the previous image.
            if (
                $product->product_image &&
                Storage::disk('public')->exists(
                    $product->product_image
                )
            ) {
                Storage::disk('public')->delete(
                    $product->product_image
                );
            }

            $imagePath = $newImagePath;
        }

        $product->update([
            'product_name' => $validated['product_name'],
            'category' => $validated['category'],
            'quantity' => $validated['quantity'],
            'unit' => $validated['unit'],
            'price' => $validated['price'],
            'minimum_price' => $validated['minimum_price'],
            'district' => $validated['district'],
            'city' => $validated['city'],
            'product_image' => $imagePath,
            'description' => $validated['description'],
        ]);

        return redirect()
            ->route('farmer.products.myProducts')
            ->with('success', 'Product updated successfully.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductManageController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string','max:100',],

            'availability' => ['nullable', 'string', 'max:30',],

            'moderation' => ['nullable','in:active,removed',],

            'demand' => ['nullable','in:High Demand,Low Demand',],
        ]);

        $search = trim($validated['search'] ?? '');

        $availability = $validated['availability'] ?? '';

        $moderation = $validated['moderation'] ?? '';

        $demand = $validated['demand'] ?? '';

        $products = Product::with(['farmer', 'removedBy',])

            ->when(
                $search !== '',
                function ($query) use ($search) {
                    $query->where(
                        function ($productQuery) use ($search) {
                            $productQuery
                                ->where(
                                    'product_name',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'category',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'city',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'district',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhereHas(
                                    'farmer',
                                    function ($farmerQuery) use ($search) {
                                        $farmerQuery
                                            ->where(
                                                'name',
                                                'like',
                                                "%{$search}%"
                                            )
                                            ->orWhere(
                                                'email',
                                                'like',
                                                "%{$search}%"
                                            );
                                    }
                                );
                        }
                    );
                }
            )

            ->when(
                $availability !== '',
                fn ($query) =>
                    $query->where(
                        'availability_status',
                        $availability
                    )
            )

            ->when(
                $moderation !== '',
                fn ($query) =>
                    $query->where(
                        'moderation_status',
                        $moderation
                    )
            )

            ->when(
                $demand !== '',
                fn ($query) =>
                    $query->where(
                        'demand_level',
                        $demand
                    )
            )

            ->latest()
            ->paginate(10)
            ->withQueryString();

        $availabilityOptions = Product::query()
            ->whereNotNull('availability_status')
            ->distinct()
            ->orderBy('availability_status')
            ->pluck('availability_status');

        return view(
            'admin.productManage',
            compact(
                'products',
                'search',
                'availability',
                'moderation',
                'demand',
                'availabilityOptions'
            )
        );
    }

    public function remove(Request $request,Product $product) 
    {
        $validated = $request->validate([
            'removal_reason' => ['required','string','min:5','max:500',],
        ]);

        if ($product->moderation_status === 'removed') {
            return back()->with(
                'error',
                'This product listing has already been removed.'
            );
        }

        $product->moderation_status = 'removed';
        $product->removal_reason = $validated['removal_reason'];
        $product->removed_by = $request->user()->id;
        $product->removed_at = now();
        $product->save();

        return redirect()
            ->route('admin.productManage')
            ->with(
                'success',
                "{$product->product_name} was removed successfully."
            );
    }

    public function restore(Product $product)
    {
        if ($product->moderation_status !== 'removed') {
            return back()->with(
                'error',
                'This product listing is already active.'
            );
        }

        $product->moderation_status = 'active';
        $product->removal_reason = null;
        $product->removed_by = null;
        $product->removed_at = null;
        $product->save();

        return redirect()
            ->route('admin.productManage')
            ->with(
                'success',
                "{$product->product_name} was restored successfully."
            );
    }
}
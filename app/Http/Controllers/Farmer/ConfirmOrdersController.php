<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Demand;
use App\Services\DemandAnalysisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConfirmOrdersController extends Controller
{
    public function index()
    {
        $orders = Order::with([
                'offer',
                'product',
                'buyer',
            ])
            ->where('farmer_id', Auth::id())
            ->latest()
            ->get();

        return view('farmer.confirmOrders', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order, DemandAnalysisService $demandAnalysisService)
    {
        abort_unless(
            (int) $order->farmer_id === (int) Auth::id(),
            403,
            'You are not authorized to manage this order.'
        );

        $validated = $request->validate([
            'order_status' => [
                'required',
                'in:confirmed,ready_for_pickup,completed,cancelled',
            ],
        ]);

        $currentStatus = strtolower(
            trim($order->order_status)
        );

        $newStatus = $validated['order_status'];

        $allowedTransitions = [
            'pending' => [
                'confirmed',
                'cancelled',
            ],

            'confirmed' => [
                'ready_for_pickup',
                'cancelled',
            ],

            'ready_for_pickup' => [
                'completed',
            ],

            'completed' => [],

            'cancelled' => [],
        ];

        if (! in_array(
            $newStatus,
            $allowedTransitions[$currentStatus] ?? [],
            true
        )) {
            return back()->with(
                'error',
                'This order status change is not allowed.'
            );
        }

        DB::transaction(function () use (
            $order,
            $newStatus,
            $demandAnalysisService
        ) {
            // Update the order status.
            $order->update([
                'order_status' => $newStatus,
            ]);

            /*
            * Completed order:
            * mark the product as sold and update demand analysis.
            */
            if ($newStatus === 'completed') {
                $product = Product::findOrFail(
                    $order->product_id
                );

                $product->update([
                    'availability_status' => 'Sold Out',
                ]);

                $demandActivity = Demand::firstOrCreate(
                    [
                        'buyer_id' => $order->buyer_id,
                        'product_id' => $order->product_id,
                        'activity_type' => 'order',
                    ],
                    [
                        'activity_date' => now(),
                    ]
                );

                if ($demandActivity->wasRecentlyCreated) {
                    $demandAnalysisService->analyzeProduct(
                        $product
                    );
                }
            }

            /*
            * Cancelled order:
            * make the product available and reject its accepted offer.
            */
            if ($newStatus === 'cancelled') {
                Product::where(
                    'product_id',
                    $order->product_id
                )->update([
                    'availability_status' => 'Available',
                ]);

                Offer::where(
                    'offer_id',
                    $order->offer_id
                )->update([
                    'status' => 'rejected',
                    'rejected_by' => 'farmer',
                    'accepted_by' => null,
                ]);
            }
        });

        $statusLabel = match ($newStatus) {
            'confirmed' => 'confirmed',

            'ready_for_pickup' => 'marked as ready for pickup',

            'completed' => 'completed',

            'cancelled' => 'cancelled',
        };

        return back()->with('success',"Order {$statusLabel} successfully.");
    }
}
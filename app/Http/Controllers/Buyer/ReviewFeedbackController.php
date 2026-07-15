<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewFeedbackController extends Controller
{
    public function store(Request $request, Order $order)
    {
        // Only the Buyer who owns this order can submit a review.
        abort_unless(
            (int) $order->buyer_id === (int) Auth::id(),
            403,
            'You are not authorized to review this order.'
        );

        // Reviews are allowed only after the order is completed.
        if (strtolower($order->order_status) !== 'completed') {
            return back()->with(
                'error',
                'You can review this order only after it is completed.'
            );
        }

        // One review is allowed per order.
        if ($order->review()->exists()) {
            return back()->with(
                'error',
                'You have already reviewed this order.'
            );
        }

        $validated = $request->validate([
            'rating' => [
                'required',
                'integer',
                'between:1,5',
            ],

            'comment' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        Review::create([
            'order_id' => $order->order_id,
            'product_id' => $order->product_id,
            'buyer_id' => Auth::id(),
            'farmer_id' => $order->farmer_id,
            'rating' => $validated['rating'],
            'commennt' => $validated['comment'] ?? null,
        ]);

        return back()->with('success', 'Thank you! Your review was submitted successfully.');
    }
}
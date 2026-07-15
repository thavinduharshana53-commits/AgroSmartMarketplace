<?php

namespace App\Services;

use App\Models\Offer;
use App\Models\Order;
use LogicException;

class OrderService
{
    public function createFromAcceptedOffer(Offer $offer): Order
    {
        if (strtolower($offer->status) !== 'accepted') {
            throw new LogicException(
                'Only accepted offers can be converted into orders.'
            );
        }

        $offer->loadMissing('product');

        $acceptedPrice = $offer->accepted_by === 'buyer' ? $offer->counter_price : $offer->offer_price;

        if ($acceptedPrice === null) {
            throw new LogicException(
                'The accepted price is unavailable.'
            );
        }

        $totalAmount = (float) $acceptedPrice * (float) $offer->quantity;

        return Order::firstOrCreate(
            [
                'offer_id' => $offer->offer_id,
            ],
            [
                'product_id' => $offer->product_id,
                'buyer_id' => $offer->buyer_id,
                'farmer_id' => $offer->product->farmer_id,
                'quantity' => $offer->quantity,
                'accepted_price' => $acceptedPrice,
                'total_amount' => round($totalAmount, 2),
                'order_status' => 'pending',
            ]
        );
    }
}
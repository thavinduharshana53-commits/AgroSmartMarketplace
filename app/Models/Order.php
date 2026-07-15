<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'offer_id',
        'product_id',
        'buyer_id',
        'farmer_id',
        'quantity',
        'accepted_price',
        'total_amount',
        'order_status',
    ];

    public function offer(){
        return $this->belongsTo(Offer::class, 'offer_id', 'offer_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function buyer(){
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }

    public function farmer(){
        return $this->belongsTo(User::class, 'farmer_id', 'id');
    }

    public function review(){
        return $this->hasOne(Review::class, 'order_id', 'order_id');
    }
}

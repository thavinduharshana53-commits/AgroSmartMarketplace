<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = 'review_id';

    protected $fillable = [
        'order_id',
        'buyer_id',
        'farmer_id',
        'product_id',
        'rating',
        'commennt'
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function buyer(){
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }

    public function farmer(){
        return $this->belongsTo(User::class, 'farmer_id', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}

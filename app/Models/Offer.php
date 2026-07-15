<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $primaryKey = 'offer_id';

    protected $fillable = [
        'product_id',
        'buyer_id',
        'offer_price',
        'counter_price',
        'quantity',
        'note',
        'counter_note',
        'status',
        'rejected_by',
        'accepted_by'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function buyer(){
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }

    public function order(){
        return $this->hasOne(Order::class, 'offer_id', 'offer_id');
    }

}

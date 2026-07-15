<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    protected $fillable =[
        'farmer_id',
        'product_name',
        'category',
        'quantity',
        'price',
        'minimum_price',
        'district',
        'city',
        'product_image',
        'description',
        'demand_level',
        'availability_status'
    ];

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    public function offers(){
        return $this->hasMany(Offer::class, 'product_id', product_id);
    }

    public function review(){
        return $this->hasMany(Review::class,'product_id','product_id');
    }
}

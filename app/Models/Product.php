<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


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
        'availability_status',
        'moderation_status',
        'removal_reason',
        'removed_by',
        'removed_at',
    ];

    protected $casts = [
        'removed_at' => 'datetime',
    ];

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id', 'id');
    }

    public function offers(){
        return $this->hasMany(Offer::class, 'product_id', product_id);
    }

    public function review(){
        return $this->hasMany(Review::class,'product_id','product_id');
    }

    public function demand(){
        return $this->hasMany(Demand::class, 'product_id', 'product_id');
    }

    public function removedBy(){
        return $this->belongsTo(User::class, 'removed_by', 'id');
    }
}

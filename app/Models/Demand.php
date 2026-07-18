<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $table = 'demand_activities';
    
    protected $primaryKey = 'demand_id';

    public $timestamps = false;

    protected $fillable =[
        'buyer_id',
        'product_id',
        'activity_type',
        'activity_date',
    ];

    protected $casts = [
        'activity_date' => 'datetime',
    ];


    public function buyer(){
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}

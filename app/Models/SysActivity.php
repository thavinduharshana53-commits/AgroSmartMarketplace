<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysActivity extends Model

{   
    protected $table = 'system_activities';
    
    protected $primaryKey = 'activity_id';

    protected $fillable = [
        'user_id',
        'action',
        'module',
        'description',
        'ip_address',
        'user_agent',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'status',
        'price',
        'billing_cycle',
        'session_id',
        'user_id',
        'plan_id'
    ];
}

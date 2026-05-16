<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
     protected $fillable = [

        'order_id',

        'payment_type',

        'amount',

        'bank_name',

        'account_name',

        'account_number',

        'payment_proof',

        'status',

        'admin_notes',

        'confirmed_at',
    ];

    protected $casts = [

        'confirmed_at' => 'datetime',
    ];

    // =========================
    // RELATION
    // =========================

    public function order()
    {
        return $this->belongsTo(
            Order::class
        );
    }
}

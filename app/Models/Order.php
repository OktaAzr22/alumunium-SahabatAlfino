<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [

        'user_id',

        'product_id',

        'code',

        'estimated_price',

        'final_price',

        'status_id',

        'user_notes',

        'admin_notes',

        'design_file',

        'service_price',

'other_price',

'dp_amount',

        'finished_at',
    ];

    protected $casts = [

        'finished_at' => 'datetime',
    ];

    // =========================
    // RELATION USER
    // =========================
    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    // =========================
    // RELATION PRODUCT
    // =========================
    public function product()
    {
        return $this->belongsTo(
            Product::class
        );
    }

    // =========================
    // RELATION DETAIL
    // =========================
    public function detail()
    {
        return $this->hasOne(
            OrderDetail::class
        );
    }

    // =========================
    // RELATION STATUS
    // =========================
    public function status()
    {
        return $this->belongsTo(
            OrderStatus::class,
            'status_id'
        );
    }

    // =========================
    // RELATION PAYMENTS
    // =========================
    public function payments()
    {
        return $this->hasMany(
            Payment::class
        );
    }

    // =========================
    // RELATION ACCESSORIES
    // =========================
    public function accessories()
    {
        return $this->belongsToMany(
            Accessory::class,
            'order_accessories'
        )
        ->withPivot([
            'qty',
            'price',
            'subtotal'
        ])
        ->withTimestamps();
    }
}
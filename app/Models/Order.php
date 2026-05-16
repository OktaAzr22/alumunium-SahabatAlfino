<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [

        'user_id',

        'code',

        'estimated_price',

        'final_price',

        'status',

        'user_notes',

        'admin_notes',

        'design_file',

        'finished_at',
    ];

    protected $casts = [

        'finished_at' => 'datetime',
    ];

    // =========================
    // RELATION
    // =========================
    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    public function detail()
    {
        return $this->hasOne(
            OrderDetail::class
        );
    }

    public function product()
    {
        return $this->hasOneThrough(
            Product::class,
            OrderDetail::class,
            'order_id', // foreign key order_details
            'id',       // foreign key products
            'id',       // local key orders
            'product_id'// local key order_details
        );
    }
}
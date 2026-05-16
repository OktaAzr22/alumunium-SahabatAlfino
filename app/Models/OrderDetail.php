<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [

        'order_id',

        'product_id',

        'length',

        'width',

        'height',

        'area',

        'qty',

        'material_id',

        'material_qty',

        'unit_price',

        'subtotal',

        'notes',
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

    public function product()
    {
        return $this->belongsTo(
            Product::class
        );
    }

    public function material()
    {
        return $this->belongsTo(
            Material::class
        );
    }

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
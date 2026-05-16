<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    protected $fillable = [

        'name',

        'price',

        'is_active',
    ];

    // =========================
    // RELATION
    // =========================
    public function orderDetails()
{
    return $this->belongsToMany(
        OrderDetail::class,
        'order_accessories',
        'accessory_id',
        'order_detail_id'
    );
}
}
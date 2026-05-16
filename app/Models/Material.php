<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [

        'name',

        'price',

        'unit',

        'description',

        'is_active',
    ];

    // =========================
    // RELATION
    // =========================
    public function orderDetails()
    {
        return $this->hasMany(
            OrderDetail::class
        );
    }
}
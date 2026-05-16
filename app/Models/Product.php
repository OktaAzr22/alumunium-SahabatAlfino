<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [

        'name',

        'description',

        'base_price',

        'standard_length',

        'standard_width',

        'standard_height',

        'frame_multiplier',

        'image',

        'is_active',
    ];

    // =========================
    // IMAGE URL
    // =========================
    public function getImageUrlAttribute()
    {
        if (!$this->image) {

            return null;
        }

        return asset(
            'storage/' . $this->image
        );
    }

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
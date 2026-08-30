<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'text',
        'rating',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
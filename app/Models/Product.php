<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'gender',
        'variant',
        'top_notes',
        'middle_notes',
        'base_notes',
        'packaging',
        'size',
        'price',
        'stock',
        'best_seller',
        'image',
        'description',
        'tagline',
    ];

    protected $casts = [
        'price'       => 'integer',
        'stock'       => 'integer',
        'best_seller' => 'boolean',
    ];

    // ── Scopes ──────────────────────────────────────────────

    public function scopeByGender($query, $gender)
    {
        if ($gender && strtolower($gender) !== 'all') {
            return $query->where('gender', $gender);
        }
        return $query;
    }

    public function scopeByVariant($query, $variant)
    {
        if ($variant && strtolower($variant) !== 'all') {
            return $query->where('variant', $variant);
        }
        return $query;
    }

    public function scopeSearch($query, $q)
    {
        if ($q) {
            return $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('variant', 'like', "%{$q}%")
                    ->orWhere('top_notes', 'like', "%{$q}%");
            });
        }
        return $query;
    }

    public function scopeLowStock($query, $threshold = 20)
    {
        return $query->where('stock', '>', 0)->where('stock', '<', $threshold);
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('stock', 0);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'discount_percentage',
        'description',
    ];

    /**
     * Get the products that have this offer.
     */
    /** @return HasMany<Product, Offer> */
    public function products(): HasMany
    {
        // Relación 1:N - Una oferta puede aplicarse a muchos productos
        return $this->hasMany(Product::class);
    }
}

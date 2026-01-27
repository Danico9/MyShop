<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{

    // Campos que permitimos asignar masivamente (coinciden con la migración)
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Get the products for the category.
     */
    /** @return HasMany<Product, Category> */
    public function products(): HasMany
    {
        // Relación 1:N -> Una categoría tiene muchos productos
        return $this->hasMany(Product::class);
    }
}

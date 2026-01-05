<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'offer_id',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2', // Convierte automáticamente el precio a decimal con 2 dígitos [cite: 446]
        ];
    }

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        // Relación: Cada producto pertenece a una categoría [cite: 444]
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the offer that applies to this product.
     */
    public function offer(): BelongsTo
    {
        // Relación: Cada producto puede tener una oferta (nullable) [cite: 444]
        return $this->belongsTo(Offer::class);
    }

    /**
     * Get the users who have this product in their cart (N:M relationship).
     */
    public function users(): BelongsToMany
    {
        // Relación N:M con usuarios a través de la tabla pivot product_user [cite: 445]
        return $this->belongsToMany(User::class, 'product_user')
            ->withPivot('quantity') // Acceso al campo extra 'quantity'
            ->withTimestamps();
    }

    /**
     * Get the product's final price after applying discounts.
     */
    protected function finalPrice(): Attribute
    {
        return Attribute::make(
            get: function () {
                // Calcula el precio final si existe una oferta activa [cite: 440-441]
                if ($this->offer && $this->offer->discount_percentage > 0) {
                    $discount = $this->price * ($this->offer->discount_percentage / 100);
                    return round($this->price - $discount, 2);
                }
                return $this->price;
            },
        );
    }
}

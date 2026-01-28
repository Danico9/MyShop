<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo que representa un pedido realizado por un usuario
 */
class Order extends Model
{
    /**
     * Atributos que pueden asignarse de forma masiva.
     *
     * Se utilizan al crear o actualizar pedidos mediante métodos
     * como create() o update(), evitando problemas de seguridad.
     */
    protected $fillable = [
        'user_id',       // Usuario que realizó el pedido
        'total_price',   // Precio total del pedido
        'status',        // Estado del pedido (pendiente, pagado, enviado, etc.)
    ];

    /**
     * Relación muchos a uno con el modelo User.
     * Un pedido pertenece a un único usuario.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación uno a muchos con el modelo OrderItem.
     * Un pedido puede contener varios productos (items).
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}

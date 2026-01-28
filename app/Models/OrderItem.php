<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo que representa un producto dentro de un pedido
 */
class OrderItem extends Model
{
    /**
     * Atributos que pueden asignarse de forma masiva.
     * Permiten crear o actualizar items de un pedido de forma segura
     * utilizando métodos como create() o update().
     */
    protected $fillable = [
        'order_id',      // Pedido al que pertenece el item
        'product_id',    // Producto asociado
        'product_name',  // Nombre del producto en el momento de la compra
        'price',         // Precio unitario del producto
        'quantity',      // Cantidad comprada
    ];

    /**
     * Relación muchos a uno con el modelo Order.
     * Cada item pertenece a un único pedido.
     *
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relación muchos a uno con el modelo Product.
     * Permite acceder a la información del producto asociado
     * al item del pedido.
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

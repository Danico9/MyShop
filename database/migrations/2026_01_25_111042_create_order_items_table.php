<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     *
     * Crea la tabla 'order_items' para almacenar los productos de cada pedido.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // ID autoincremental del item

            /**
             * Clave foránea hacia la tabla orders.
             *
             * - Cada item pertenece a un pedido
             * - onDelete('cascade'): si se elimina el pedido, también se eliminan sus items
             */
            $table->foreignId('order_id')->constrained()->onDelete('cascade');

            /**
             * Clave foránea hacia la tabla products.
             *
             * - Nullable: un producto puede haber sido eliminado posteriormente
             * - nullOnDelete(): si el producto se elimina, se deja en null en order_items
             */
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();

            $table->string('product_name'); // Nombre del producto en el momento de la compra (snapshot)
            $table->decimal('price', 10, 2); // Precio unitario del producto al comprarlo (snapshot)
            $table->integer('quantity');     // Cantidad comprada de este producto

            $table->timestamps(); // created_at y updated_at automáticos
        });
    }

    /**
     * Revierte la migración.
     *
     * Elimina la tabla 'order_items' si existe.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

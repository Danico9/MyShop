<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     *
     * Crea la tabla 'orders' para almacenar los pedidos realizados por los usuarios.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // ID autoincremental del pedido

            /**
             * Clave foránea hacia la tabla users.
             *
             * - foreignId('user_id'): crea la columna user_id
             * - constrained(): enlaza la columna con la tabla users
             * - onDelete('cascade'): si el usuario se elimina, también se eliminan sus pedidos
             */
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->decimal('total_price', 10, 2); // Precio total del pedido (máximo 99999999.99)

            /**
             * Estado del pedido
             *
             * - Tipo string
             * - Valor por defecto 'completed'
             * - Posibles valores: pending, completed, cancelled
             */
            $table->string('status')->default('completed');

            $table->timestamps(); // created_at y updated_at automáticos
        });
    }

    /**
     * Revierte la migración.
     *
     * Elimina la tabla 'orders' si existe, deshaciendo los cambios de up().
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

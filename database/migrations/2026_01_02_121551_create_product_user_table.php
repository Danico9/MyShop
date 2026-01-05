<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_user', function (Blueprint $table) {
            // id: Identificador único del registro en la tabla pivot
            $table->id();

            // product_id: Clave foránea al producto.
            // Primero por orden alfabético (P antes que U).
            // onDelete('cascade'): Si se borra el producto, desaparece del carrito.
            $table->foreignId('product_id')
                ->constrained()
                ->onDelete('cascade');

            // user_id: Clave foránea al usuario.
            // onDelete('cascade'): Si se borra el usuario, se vacía su carrito.
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // quantity: Campo extra (pivot enriquecida).
            // default(1): Si no decimos cuántos, se asume que es 1.
            $table->integer('quantity')->default(1);

            // timestamps: Crea created_at y updated_at.
            // Necesario para que funcione ->withTimestamps() en el modelo User.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_user');
    }
};

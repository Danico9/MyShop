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
        Schema::create('products', function (Blueprint $table) {
            // id: Identificador único
            $table->id();

            // name: Nombre del producto
            $table->string('name');

            // description: Descripción (usamos text para permitir descripciones más largas)
            $table->text('description');

            // price: Precio (decimal es mejor que float para dinero)
            // 10 dígitos en total, 2 de ellos decimales (ej: 99999999.99)
            $table->decimal('price', 10, 2);

            // category_id: Relación con Categorías (Obligatoria)
            // Si se borra la categoría, se borran sus productos (cascade)
            $table->foreignId('category_id')
                ->constrained()
                ->onDelete('cascade');

            // offer_id: Relación con Ofertas (Opcional)
            // nullable(): El producto puede no tener oferta
            // Si se borra la oferta, el producto se queda pero con offer_id = null
            $table->foreignId('offer_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

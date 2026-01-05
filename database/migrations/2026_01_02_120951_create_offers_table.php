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
        Schema::create('offers', function (Blueprint $table) {
            // id: Identificador único (auto-incremental)
            $table->id();

            // name: Nombre de la oferta
            $table->string('name');

            // slug: Identificador amigable para URLs
            // Usamos unique() para asegurar que no haya dos ofertas con el mismo slug
            $table->string('slug')->unique();

            // discount_percentage: Porcentaje de descuento (entero)
            $table->integer('discount_percentage');

            // description: Descripción breve de la oferta
            // Usamos text() por si la descripción fuera un poco más larga,
            // aunque string() también valdría si es muy breve.
            $table->text('description');

            // timestamps: Crea automáticamente created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};

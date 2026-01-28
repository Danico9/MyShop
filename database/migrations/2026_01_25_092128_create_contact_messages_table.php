<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     *
     * Crea la tabla 'contact_messages' para almacenar los mensajes
     * enviados desde el formulario de contacto.
     */
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();          // ID autoincremental de cada mensaje
            $table->string('name');    // Nombre del remitente
            $table->string('email');   // Correo electrónico del remitente
            $table->string('subject'); // Asunto del mensaje
            $table->text('message');   // Contenido del mensaje
            $table->timestamps();      // created_at y updated_at automáticos
        });
    }

    /**
     * Revierte la migración.
     *
     * Elimina la tabla 'contact_messages' si existe, deshaciendo
     * los cambios realizados por el método up().
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};

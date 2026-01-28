<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     *
     * Se añade una nueva columna a la tabla users para indicar
     * si un usuario tiene permisos de administrador.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            /**
             * Se crea la columna is_admin:
             * - Tipo booleano (true / false).
             * - Valor por defecto false, por lo que los usuarios
             *   serán normales salvo que se indique lo contrario.
             * - Se coloca después de la columna email por orden.
             */
            $table->boolean('is_admin')
                ->default(false)
                ->after('email');
        });
    }

    /**
     * Revierte la migración.
     *
     * Se elimina la columna is_admin de la tabla users en caso
     * de deshacer la migración.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Se elimina la columna añadida en el método up()
            $table->dropColumn('is_admin');
        });
    }
};

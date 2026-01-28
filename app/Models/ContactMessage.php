<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa los mensajes enviados desde el formulario de contacto
 */
class ContactMessage extends Model
{

    protected $fillable = [
        'name',     // Nombre del remitente
        'email',    // Correo electrónico del remitente
        'subject',  // Asunto del mensaje
        'message',  // Contenido del mensaje
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /** @var list<string> */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Get the products in the user's cart (N:M relationship).
     */
    public function products()
    {
        // Relación N:M con productos a través de la tabla pivot product_user
        return $this->belongsToMany(Product::class, 'product_user')
            ->withPivot('quantity') // Incluye el campo adicional quantity
            ->withTimestamps();     // Incluye created_at y updated_at de la pivot
    }
}

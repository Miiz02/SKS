<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'ndp',      // Ensure the case matches the database column
        'kursus',   // Ensure the case matches the database column
        'semester',  // Ensure the case matches the database column
        'ic',  // Ensure the case matches the database column
        'alamat',  // Ensure the case matches the database column
        'telefon',  // Ensure the case matches the database column
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

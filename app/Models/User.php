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
        'ndp',
        'kursus',
        'semester',
        'ic',
        'alamat',
        'telefon',
        'role', // Ensure the role is included
        'profile_photo', // Add this line for the profile photo
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Automatically hash the password when set
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Check if user has a specific role
    public function hasRole($role)
    {
        return $this->role === $role; // Check if the user's role matches the given role
    }

    // Example relationship
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}

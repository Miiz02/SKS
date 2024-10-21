<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'attendance_status', 
        'timestamp', 
        'picture', 
        'sebab'
    ];
    

    // Define the casts for the model attributes
    protected $casts = [
        'timestamp' => 'datetime', // Cast 'timestamp' to a Carbon instance
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

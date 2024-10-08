<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->string('attendance_status'); // Attend or Not Attend
            $table->timestamp('timestamp'); // Attendance time
            $table->string('picture')->nullable(); // Path to uploaded picture
            $table->timestamps(); // Created at and updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances'); // Drop the table if it exists
    }
}

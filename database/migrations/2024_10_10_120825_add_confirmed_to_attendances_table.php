<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConfirmedToAttendancesTable extends Migration
{
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->boolean('confirmed')->default(0); // Add confirmed column
        });
    }

    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn('confirmed'); // Remove the confirmed column
        });
    }
}

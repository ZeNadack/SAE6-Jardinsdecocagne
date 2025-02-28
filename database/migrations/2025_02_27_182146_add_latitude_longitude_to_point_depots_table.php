<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('point_depots', function (Blueprint $table) {
            $table->decimal('latitude', 10, 7)->nullable(); // Latitude avec 7 décimales
            $table->decimal('longitude', 10, 7)->nullable(); // Longitude avec 7 décimales
        });
    }

    public function down()
    {
        Schema::table('point_depots', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });
    }
};

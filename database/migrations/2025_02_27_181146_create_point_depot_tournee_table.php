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
        Schema::create('point_depot_tournee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournee_id')->constrained()->onDelete('cascade');
            $table->foreignId('point_depot_id')->constrained()->onDelete('cascade');
            $table->integer('ordre')->default(0); // Pour stocker l'ordre des points de dépôt
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_depot_tournee');
    }
};

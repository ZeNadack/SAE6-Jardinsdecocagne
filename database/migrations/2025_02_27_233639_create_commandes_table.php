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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adherent_id')->constrained()->onDelete('cascade');
            $table->foreignId('abonnement_id')->constrained()->onDelete('cascade');
            $table->foreignId('point_depot_id')->constrained()->onDelete('cascade');
            $table->date('date_livraison');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};

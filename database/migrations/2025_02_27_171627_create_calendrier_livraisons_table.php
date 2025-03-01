<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('calendrier_livraisons', function (Blueprint $table) {
        $table->id();
        $table->date('date_livraison');
        $table->boolean('est_ferie')->default(false);
        $table->boolean('est_ouvert')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendrier_livraisons');
    }
};

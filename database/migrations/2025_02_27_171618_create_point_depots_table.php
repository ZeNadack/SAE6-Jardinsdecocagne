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
    Schema::create('point_depots', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('adresse');
        $table->string('code_postal');
        $table->string('ville');
        $table->string('telephone');
        $table->string('email');
        $table->text('commentaires')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_depots');
    }
};

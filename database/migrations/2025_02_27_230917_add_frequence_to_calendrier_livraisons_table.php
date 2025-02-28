<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('calendrier_livraisons', function (Blueprint $table) {
            $table->string('frequence')->nullable(); // Ajoute la colonne "frequence"
        });
    }

    public function down()
    {
        Schema::table('calendrier_livraisons', function (Blueprint $table) {
            $table->dropColumn('frequence'); // Supprime la colonne en cas de rollback
        });
    }
};

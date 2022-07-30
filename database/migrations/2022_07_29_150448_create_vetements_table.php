<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vetements', function (Blueprint $table) {
            $table->id();
            $table->enum('statut',[
                'REÇU',
                'EN_COURS_DE_LAVAGE',
                'LAVÉ',
                'EN_COURS_DE_REPASSAGE',
                'REPASSÉ',
                'TERMINÉ'
            ])->default('REÇU');
            $table->foreignId('type_vetement_id')->constrained()->onDelete('cascade');
            $table->foreignId('commande_id')->constrained()->onDelete('cascade');
            $table->enum('service_demander',['LAVAGE','LAVAGE_REPASSAGE'])->default('LAVAGE_REPASSAGE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vetements');
    }
};

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
        Schema::create('approvisionements', function (Blueprint $table) {
            $table->id();
            $table->integer('quantite');
            $table->integer('prix_achat');
            $table->timestamp('date');
            $table->enum('type',['ENTRER','SORTIR','UPDATE'])->default('ENTRER');
            $table->foreignId('produit_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('approvisionements');
    }
};

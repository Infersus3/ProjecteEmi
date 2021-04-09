<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMostraCondCompostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mostra_cond_composts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mostra_id')->nullable()->constrained('mostras');
            $table->foreignId('condicion_id')->nullable()->constrained('condicions');
            $table->foreignId('compost_quimic_id')->nullable()->constrained('compost_quimics');
            $table->float("temps_retencio");
            $table->float("alçada_grafic");
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
        Schema::dropIfExists('mostra_cond_composts');
    }
}

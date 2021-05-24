<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTascasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tascas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practica_id')->constrained('practicas');
            $table->foreignId('grup_id')->nullable()->constrained('grups');
            $table->foreignId('alumne_id')->nullable()->constrained('alumnes');
            $table->foreignId('condicion_id')->nullable()->constrained('condicions'); 
            $table->text("comentari")->nullable();
            $table->float("nota")->nullable();
            $table->date("data_lliurament")->nullable();
            $table->string('document')->nullable();
            $table->boolean("correcta")->nullable();
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
        Schema::dropIfExists('tascas');
    }
}

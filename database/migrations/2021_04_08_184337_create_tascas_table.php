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
            $table->foreignId('practica_id')->nullable()->constrained('practicas');
            $table->foreignId('condicion_id')->nullable()->constrained('condicions');
            $table->integer("nota");
            $table->string("comentari");
            $table->date("data_lliurament");
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

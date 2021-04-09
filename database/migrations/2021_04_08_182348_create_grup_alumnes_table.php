<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupAlumnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grup_alumnes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grup_id')->nullable()->constrained('grups');
            $table->foreignId('alumne_id')->nullable()->constrained('alumnes');
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
        Schema::dropIfExists('grup_alumnes');
    }
}

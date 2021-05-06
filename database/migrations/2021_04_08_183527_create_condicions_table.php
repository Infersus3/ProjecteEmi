<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondicionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condicions', function (Blueprint $table) {
            $table->id();
            $table->integer("alçada_col");
            $table->float("temperatura");
            $table->string("eluent");
            $table->float("diametre_col");
            $table->float("tamany");
            $table->string("velocitat");
            $table->double("detector_uv");
            $table->string("neutre")->nullable();
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
        Schema::dropIfExists('condicions');
    }
}

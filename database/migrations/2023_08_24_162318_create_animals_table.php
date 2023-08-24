<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('renspa');
            $table->integer('campaign');
            $table->integer('vacas')->default(0);
            $table->integer('vaquillonas')->default(0);
            $table->integer('toros')->default(0);
            $table->integer('toritos')->default(0);
            $table->integer('terneros')->default(0);
            $table->integer('terneras')->default(0);
            $table->integer('novillos')->default(0);
            $table->integer('novillitos')->default(0);
            $table->integer('caprinos')->default(0);
            $table->integer('ovinos')->default(0);
            $table->integer('porcinos')->default(0);
            $table->integer('equinos')->default(0);
            $table->integer('bufaloMay')->default(0);
            $table->integer('bufaloMen')->default(0);
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
        Schema::dropIfExists('animals');
    }
}

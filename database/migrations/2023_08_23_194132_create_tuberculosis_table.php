<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTuberculosisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuberculosis', function (Blueprint $table) {
            $table->id();
            $table->string('renspa')->unique();
            $table->dateTime('fechaCarga');
            $table->dateTime('fechaEstado')->nulleable();
            $table->dateTime('fechaEnviado')->nulleable();
            $table->string('protocolo')->nulleable();
            $table->string('estado')->nulleable();
            $table->integer('saneamientoNum')->default(0);
            $table->string('certificado')->nulleable();
            $table->integer('positivo')->default(0);
            $table->integer('negativo')->default(0);
            $table->integer('sospechoso')->default(0);
            $table->integer('vacas')->default(0);
            $table->integer('vaquillonas')->default(0);
            $table->integer('terneros')->default(0);
            $table->integer('terneras')->default(0);
            $table->integer('novillos')->default(0);
            $table->integer('novillitos')->default(0);
            $table->integer('toros')->default(0);
            $table->boolean('notificado')->default(false);
            $table->dateTime('fechaNotificado')->nulleable();
            $table->string('estadoSenasa')->nulleable();
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
        Schema::dropIfExists('tuberculosis');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producers', function (Blueprint $table) {
            $table->id();
            $table->string('renspa')->unique();
            $table->string('propietario');
            $table->string('establecimiento');
            $table->string('veterinario');
            $table->string('tipoDoc')->nulleable();
            $table->string('numDoc')->nulleable();
            $table->string('iva')->nulleable();
            $table->string('telefono')->nulleable();
            $table->string('email')->nulleable();
            $table->string('domicilio')->nulleable();
            $table->string('localidad');
            $table->string('provincia');
            $table->integer('departamento');
            $table->integer('distrito');
            $table->string('explotacion');
            $table->string('regimen')->nulleable();
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
        Schema::dropIfExists('producers');
    }
}

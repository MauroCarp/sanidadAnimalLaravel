<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actas', function (Blueprint $table) {
            $table->id();
            $table->string('renspa');
            $table->integer('campaign');
            $table->dateTime('fechaVacunacion');
            $table->string('acta');
            $table->string('matricula');
            $table->integer('cantidad');
            $table->dateTime('fechaRecepcion');
            $table->boolean('vacunoCar');
            $table->integer('cantidadCar');
            $table->boolean('vacunoBruce');
            $table->integer('cantidadBruce');
            $table->boolean('pago');
            $table->float('admAf');
            $table->float('vacunadorAf');
            $table->float('vacunaAf');
            $table->float('admCar');
            $table->float('vacunadorCar');
            $table->float('vacunaCar');
            $table->float('redondeoAf');
            $table->float('redondeoCar');
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
        Schema::dropIfExists('actas');
    }
}

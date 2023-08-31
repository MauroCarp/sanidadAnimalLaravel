<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('renspa');
            $table->string('protocolo');
            $table->string('estado');
            $table->dateTime('fechaEstado');
            $table->dateTime('fechaCarga');
            $table->integer('sanieamiento')->default(0);
            $table->integer('positivo')->default(0);
            $table->integer('negativo')->default(0);
            $table->integer('sospechoso')->default(0);
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
        Schema::dropIfExists('records');
    }
}

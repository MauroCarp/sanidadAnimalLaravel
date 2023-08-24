<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reception', function (Blueprint $table) {
            $table->id();
            $table->integer('campaign');
            $table->string('marca');
            $table->string('uel');
            $table->string('matricula');
            $table->dateTime('fechaEntrega');
            $table->dateTime('fechaVencimiento');
            $table->integer('serie');
            $table->integer('cantidad');
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
        Schema::dropIfExists('reception');
    }
}

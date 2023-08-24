<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->integer('numero')->unique();
            $table->dateTime('inicio');
            $table->dateTime('final');
            $table->float('admA')->default(0);
            $table->float('vacunadorA')->default(0);
            $table->float('vacunaA')->default(0);
            $table->float('admC')->default(0);
            $table->float('vacunadorC')->default(0);
            $table->float('vacunaC')->default(0);
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
        Schema::dropIfExists('campaigns');
    }
}

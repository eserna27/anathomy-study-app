<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementRegions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element_regions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('element_id')->unsigned();
            $table->foreign('element_id')->references('id')->on('elements');
            $table->integer('region_id')->unsigned();
            $table->foreign('region_id')->references('id')->on('regions');
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
        Schema::dropIfExists('element_regions');
    }
}

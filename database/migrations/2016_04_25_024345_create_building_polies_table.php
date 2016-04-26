<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingPoliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_polies', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('height')->unsigned();
            $table->string('roofcolor',7);
            $table->string('wallcolor',7);
            $table->longText('polygon');
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
        Schema::drop('building_polies');
    }
}

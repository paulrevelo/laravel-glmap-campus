<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 255);
            $table->longText('description');
            $table->smallInteger('height')->unsigned();
            $table->string('roofcolor',7);
            $table->string('wallcolor',7);
            $table->string('image',70);
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

        Schema::drop('buildings');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKey extends Migration
{
/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('role_id')
                        ->references('id')
                        ->on('roles')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });

        // Schema::table('buildings', function(Blueprint $table) {
        //     $table->foreign('bpoly_id')
        //                 ->references('id')
        //                 ->on('building_polies')
        //                 ->onDelete('restrict')
        //                 ->onUpdate('restrict');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_role_id_foreign');
        });

        // Schema::table('buildings', function(Blueprint $table) {
        //     $table->dropForeign('buildings_bpoly_id_foreign');
        // });


    }
}

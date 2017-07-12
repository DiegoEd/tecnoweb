<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accions', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('pageroute');
            $table->integer('module_id')->unsigned();
            $table->foreign('module_id')->references('id')->on('modules')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::drop('accions');
    }
}

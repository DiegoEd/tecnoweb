<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('sex');
            $table->integer('age');
            $table->string('career');
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->softDeletes();
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
        Schema::drop('employees');
    }
}

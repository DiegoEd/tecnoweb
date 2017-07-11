<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSaleBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_bill_details', function(Blueprint $table) {
            $table->increments('id');
            $table->decimal('price');
            $table->integer('amount');
            $table->integer('product_id');
            $table->integer('sales_bill_id');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('sales_bill_id')->references('id')->on('sales_bills')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sale_bill_details');
    }
}

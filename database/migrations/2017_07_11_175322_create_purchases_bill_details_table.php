<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchasesBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases_bill_details', function(Blueprint $table) {
            $table->increments('id');
            $table->decimal('price');
            $table->integer('amount');
            $table->integer('purchases_bill_id');
            $table->integer('product_id');
            $table->timestamps();
            $table->foreign('purchases_bill_id')->references('id')->on('purchases_bills')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')
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
        Schema::drop('purchases_bill_details');
    }
}

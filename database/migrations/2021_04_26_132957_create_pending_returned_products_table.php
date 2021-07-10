<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingReturnedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_returned_products', function (Blueprint $table) {
            $table->id();
            $table->string('return_id');
            $table->integer('purchase_order_number_id');
            $table->text('name');
            $table->float('case', 8, 2);
            $table->string('status_id');
            $table->float('deposit', 8, 2);
            $table->text('note')->nullable();
            $table->integer('isRemove')->default(0);
           
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
        Schema::dropIfExists('pending_returned_products');
    }
}

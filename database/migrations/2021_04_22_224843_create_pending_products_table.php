<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_products', function (Blueprint $table) {
            $table->id();
            $table->string('category_id');
            $table->string('purchase_order_number_id');
            $table->string('name');

            $table->integer('stock');
            $table->integer('pcs');

            
            $table->string('size');
            $table->integer('sales')->default(0);
            $table->date('expiration');
            
            $table->float('purchase_amount', 8, 2);
            $table->float('profit', 8, 2);
            $table->float('price', 8, 2);

            $table->float('total_amount_purchase', 8, 2);
            $table->float('total_profit', 8, 2);
            $table->float('total_price', 8, 2);
            
           
            $table->text('note')->nullable();
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
        Schema::dropIfExists('pending_products');
    }
}

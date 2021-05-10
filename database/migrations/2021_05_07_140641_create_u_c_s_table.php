<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUCSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_c_s', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_order_number_id');
            $table->string('inventory_id');
            $table->float('ucs', 8, 2);
            $table->float('case', 8, 2);
            $table->integer('isRemove')->default(0);
            $table->integer('isPurchase')->default(0);
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
        Schema::dropIfExists('u_c_s');
    }
}

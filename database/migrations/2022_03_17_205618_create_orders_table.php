<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('user_id');
            $table->string('phone');
            $table->unsignedBigInteger('user_id');
            $table->string('division');
            $table->string('district');
            $table->string('upazila');
            $table->string('address');
            $table->string('delivery_type');
            $table->string('shipping_charge')->default(50);
            $table->boolean('status')->default(0)->comment('0= Not approved, 1= Approved');
            $table->string('total_price');
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
        Schema::dropIfExists('orders');
    }
}

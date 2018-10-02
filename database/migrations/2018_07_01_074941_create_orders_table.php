<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('set null');

            $table->string('email');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('address');
            $table->string('zip');
            $table->string('city');
            $table->string('state');
            $table->string('discount')->default(0);
            $table->string('discount_code')->nullable();
            $table->string('tax');
            $table->string('subtotal');
            $table->string('total');
            $table->string('last4');
            $table->string('payment_gateway')->default('stripe');
            $table->boolean('shipped')->default(0);
            $table->string('error')->nullable();
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

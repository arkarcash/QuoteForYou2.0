<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('order_id');
            $table->bigInteger('user_id');
            $table->unsignedBigInteger('township_id');
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->string('payment_slip')->nullable();
            $table->string('note')->nullable();
            $table->enum('status',[0,1,2,3,4])->default(0)->comment('confirm,delivered,complete,cancel');
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
};

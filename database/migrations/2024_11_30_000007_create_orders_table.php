<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('street')->nullable();
            $table->string('building_number')->nullable();
            $table->string('mobile', 13);
            $table->string('email')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->enum('order_status', ['Pending', 'Processing','Completed'])->default('Pending');
            $table->string('note')->nullable();
            $table->enum('payment_method', ['paypal', 'stripe','cashOnDelivery'])->default('cashOnDelivery');
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('small_description');
            $table->text('description');
            $table->float('old_price')->nullable();
            $table->float('price');
            $table->integer('discount')->nullable();
            $table->unsignedInteger('quantity');
            $table->enum('is_bestseller', ['true', 'false'])->default('false');
            $table->enum('is_new', ['true', 'false'])->default('false');
            $table->boolean('top_product')->default(0);
            
            $table->unsignedBigInteger('subCategory_id');
            $table->foreign('subCategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

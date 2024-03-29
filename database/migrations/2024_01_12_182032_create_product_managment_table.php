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
        Schema::create('product_managment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id'); 
            $table->unsignedBigInteger('sub_category_id'); 
            $table->string('product_name');
            $table->string('image');
            $table->string('price');
            $table->string('discount');
            $table->string('final_price');
            $table->timestamps();
        
            // Define foreign key constraints
            $table->foreign('category_id')->references('id')->on('category');
            $table->foreign('sub_category_id')->references('id')->on('sub_category');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_managment');
    }
};

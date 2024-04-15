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
           $table->string('color');
           $table->string('size');
           $table->string('gender');
           $table->string('type');
            $table->string('category');
            $table->integer('remain_quantity')->default(0);
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->text('description');
            //$table->unsignedBigInteger('sales_id');
            
            $table->timestamps();


           // $table->foreign('sales_id')->references('id')->on('sales')
          // ->references('id')
          // ->on('categories')
         //  ->onDelete('cascade');
            
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

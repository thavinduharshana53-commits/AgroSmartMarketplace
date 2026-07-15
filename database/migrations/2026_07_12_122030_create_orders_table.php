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
            $table->id('order_id');

            $table->foreignId('offer_id')
                  ->unique()
                  ->references('offer_id')
                  ->on('offers')
                  ->onDelete('cascade');

            $table->foreignId('product_id')
                  ->references('product_id')
                  ->on('products')
                  ->onDelete('cascade');

            $table->foreignId('buyer_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreignId('farmer_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            
            $table->decimal('quantity', 10,2);
            $table->decimal('accepted_price', 10,2);
            $table->decimal('total_amount', 12,2);
            $table->enum('order_status', ['pending','confirmed','processing','completed','cancelled'])
                  ->default('pending');





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

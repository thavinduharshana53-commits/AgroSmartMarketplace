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
        Schema::create('offers', function (Blueprint $table) {
            $table->id('offer_id');
           $table->foreignId('product_id')
                 ->references('product_id')
                 ->on('products')
                 ->onDelete('cascade');
            $table->foreignId('buyer_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->decimal('offer_price', 10, 2);
            $table->decimal('quantity', 10, 2);
            $table->text('note')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected', 'countered'])
                  ->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};

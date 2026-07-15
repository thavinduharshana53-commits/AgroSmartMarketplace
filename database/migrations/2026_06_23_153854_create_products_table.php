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
            $table->id('product_id');
            $table->foreignId('farmer_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->string('product_name');
            $table->string('category');
            $table->decimal('quantity', 10, 2);
            $table->decimal('price', 10, 2);
            $table->decimal('minimum_price', 10, 2);
            $table->string('district');
            $table->string('city');
            $table->string('product_image')->nullable();
            $table->text('description');
            $table->enum('demand_level', ['High Demand', 'Low Demand']);
            $table->enum('availability_status', ['Available', 'Unavailable']);
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

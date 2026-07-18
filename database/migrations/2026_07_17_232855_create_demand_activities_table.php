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
        Schema::create('demand_activities', function (Blueprint $table) {
            $table->id('demand_id');

            $table->foreignId('buyer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreignId('product_id')
                ->references('product_id')
                ->on('products')
                ->onDelete('cascade');

            $table->enum('activity_type', ['search', 'view', 'offer', 'order'])->default('search');
            $table->timestamp('activity_date')->useCurrent();
            $table->index(['product_id','activity_type',]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demand_activities');
    }
};

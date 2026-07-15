<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE orders
            MODIFY order_status ENUM(
                'pending',
                'confirmed',
                'processing',
                'ready_for_pickup',
                'completed',
                'cancelled'
            ) DEFAULT 'pending'
        ");

        DB::table('orders')
            ->where('order_status', 'processing')
            ->update([
                'order_status' => 'ready_for_pickup',
            ]);

        DB::statement("
            ALTER TABLE orders
            MODIFY order_status ENUM(
                'pending',
                'confirmed',
                'ready_for_pickup',
                'completed',
                'cancelled'
            ) DEFAULT 'pending'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE orders
            MODIFY order_status ENUM(
                'pending',
                'confirmed',
                'processing',
                'ready_for_pickup',
                'completed',
                'cancelled'
            ) DEFAULT 'pending'
        ");

        DB::table('orders')
            ->where('order_status', 'ready_for_pickup')
            ->update([
                'order_status' => 'processing',
            ]);

        DB::statement("
            ALTER TABLE orders
            MODIFY order_status ENUM(
                'pending',
                'confirmed',
                'processing',
                'completed',
                'cancelled'
            ) DEFAULT 'pending'
        ");
    }
};
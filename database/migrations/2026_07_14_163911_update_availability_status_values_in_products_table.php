<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Add the new product availability status values.
        DB::statement("
            ALTER TABLE products
            MODIFY availability_status
            ENUM(
                'Available',
                'Reserved',
                'Sold Out',
                'Unavailable'
            )
            NOT NULL
        ");

        // Existing unavailable products have accepted orders,
        // so temporarily convert them to Reserved.
        DB::table('products')
            ->where('availability_status', 'Unavailable')
            ->update([
                'availability_status' => 'Reserved',
            ]);

        // Remove the old Unavailable value.
        DB::statement("
            ALTER TABLE products
            MODIFY availability_status
            ENUM(
                'Available',
                'Reserved',
                'Sold Out'
            )
            NOT NULL
        ");
    }

    public function down(): void
    {
        // Temporarily add Unavailable again.
        DB::statement("
            ALTER TABLE products
            MODIFY availability_status
            ENUM(
                'Available',
                'Reserved',
                'Sold Out',
                'Unavailable'
            )
            NOT NULL
        ");

        // Convert the new statuses back to Unavailable.
        DB::table('products')
            ->whereIn('availability_status', [
                'Reserved',
                'Sold Out',
            ])
            ->update([
                'availability_status' => 'Unavailable',
            ]);

        // Restore the original enum values.
        DB::statement("
            ALTER TABLE products
            MODIFY availability_status
            ENUM(
                'Available',
                'Unavailable'
            )
            NOT NULL
        ");
    }
};
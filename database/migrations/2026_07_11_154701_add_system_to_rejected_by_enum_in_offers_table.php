<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE offers
            MODIFY rejected_by ENUM('farmer', 'buyer', 'system')
            NULL
        ");
    }

    public function down(): void
    {
        DB::table('offers')
            ->where('rejected_by', 'system')
            ->update(['rejected_by' => null]);

        DB::statement("
            ALTER TABLE offers
            MODIFY rejected_by ENUM('farmer', 'buyer')
            NULL
        ");
    }
};
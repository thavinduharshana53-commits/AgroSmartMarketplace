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
        Schema::table('users', function (Blueprint $table) {
            $table->string('district')->nullable()->after('role');
            $table->string('city')->nullable()->after('district');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             if (Schema::hasColumn('users', 'district')) {
            $table->dropColumn('district');
        }

        if (Schema::hasColumn('users', 'city')) {
            $table->dropColumn('city');
        }
        });
    }
};

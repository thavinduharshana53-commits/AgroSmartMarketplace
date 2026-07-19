<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table
                ->string('moderation_status', 20)
                ->default('active')
                ->index();

            $table->text('removal_reason')->nullable();

            $table
                ->foreignId('removed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('removed_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['removed_by']);
            $table->dropIndex(['moderation_status']);

            $table->dropColumn([
                'moderation_status',
                'removal_reason',
                'removed_by',
                'removed_at',
            ]);
        });
    }
};
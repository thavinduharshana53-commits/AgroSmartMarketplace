<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_activities', function (Blueprint $table) {
            $table->id('activity_id');

            $table
                ->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('action', 100);

            $table
                ->string('module', 50)
                ->index();

            $table->text('description');

            $table
                ->string('ip_address', 45)
                ->nullable();

            $table
                ->string('user_agent', 500)
                ->nullable();

            $table->timestamps();

            $table->index(['action', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_activities');
    }
};
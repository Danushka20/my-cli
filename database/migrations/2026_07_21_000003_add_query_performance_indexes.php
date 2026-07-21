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
        Schema::table('jobs', function (Blueprint $table) {
            $table->index(['queue', 'reserved_at', 'available_at'], 'jobs_queue_reserved_available_idx');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('email_verified_at');
            $table->index('created_at');
        });

        Schema::table('sessions', function (Blueprint $table) {
            $table->index(['user_id', 'last_activity'], 'sessions_user_last_activity_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropIndex('jobs_queue_reserved_available_idx');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['email_verified_at']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('sessions', function (Blueprint $table) {
            $table->dropIndex('sessions_user_last_activity_idx');
        });
    }
};

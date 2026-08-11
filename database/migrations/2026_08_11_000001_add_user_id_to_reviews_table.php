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
        Schema::table('reviews', function (Blueprint $table) {
            if (!Schema::hasColumn('reviews', 'user_id')) {
                $table->integer('user_id')->nullable()->default(0);
            }
            if (!Schema::hasColumn('reviews', 'property_id')) {
                $table->integer('property_id')->nullable()->default(0);
            }
            if (!Schema::hasColumn('reviews', 'agent_id')) {
                $table->integer('agent_id')->nullable()->default(0);
            }
            if (!Schema::hasColumn('reviews', 'rating')) {
                $table->integer('rating')->default(5);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            //
        });
    }
};

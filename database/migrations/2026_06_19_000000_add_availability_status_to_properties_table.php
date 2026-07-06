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
        if (!Schema::hasColumn('properties', 'availability_status')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->string('availability_status')->default('available');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('properties', 'availability_status')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->dropColumn('availability_status');
            });
        }
    }
};

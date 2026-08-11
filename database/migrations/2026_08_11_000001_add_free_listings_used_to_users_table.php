<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'free_listings_used')) {
            Schema::table('users', function (Blueprint $table) {
                $table->integer('free_listings_used')->default(0)->after('status');
            });

            // Populate initial free_listings_used for existing users based on existing property count (capped at 5)
            $users = DB::table('users')->get();
            foreach ($users as $user) {
                $propCount = DB::table('properties')->where('agent_id', $user->id)->count();
                $initialFree = min(5, $propCount);
                if ($initialFree > 0) {
                    DB::table('users')->where('id', $user->id)->update(['free_listings_used' => $initialFree]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'free_listings_used')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('free_listings_used');
            });
        }
    }
};

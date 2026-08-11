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
            if (!Schema::hasColumn('users', 'verify_token')) {
                $table->string('verify_token', 191)->nullable();
            }
            if (!Schema::hasColumn('users', 'email_verified')) {
                $table->tinyInteger('email_verified')->default(1);
            }
            if (!Schema::hasColumn('users', 'login_type')) {
                $table->string('login_type', 50)->default('user');
            }
            if (!Schema::hasColumn('users', 'forget_password_token')) {
                $table->string('forget_password_token', 191)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

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
        Schema::table('company_profiles', function (Blueprint $table) {
            $table->foreignId('city_id')->nullable();
            $table->foreignId('state_id')->nullable();
            $table->string('rera_number')->nullable();
            $table->string('gst_number')->nullable();
            $table->string('id_proof')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_profiles', function (Blueprint $table) {
            $table->dropColumn(['city_id', 'state_id', 'rera_number', 'gst_number', 'id_proof']);
        });
    }
};

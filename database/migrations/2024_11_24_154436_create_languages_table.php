<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('lang_code')->nullable();
            $table->string('lang_name')->nullable();
            $table->string('country_code')->nullable();
            $table->string('is_default')->nullable();
            $table->integer('status')->default(0);
            $table->string('lang_direction')->nullable();
            $table->timestamps();
        });

        DB::table('languages')->insert([
            'lang_code' => 'en',
            'lang_name' => 'English',
            'country_code' => 'US',
            'is_default' => 'yes',
            'status' => 1,
            'lang_direction' => 'left_to_right',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};

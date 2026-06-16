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
        Schema::create('multi_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('currency_name');
            $table->string('currency_code');
            $table->string('country_code');
            $table->string('currency_icon');
            $table->string('is_default')->default('no');
            $table->decimal('currency_rate', 8, 2);
            $table->string('currency_position')->default('before_price');
            $table->string('status')->default('active');
            $table->timestamps();
        });

        DB::table('multi_currencies')->insert([
            'currency_name' => 'USD',
            'currency_code' => 'USD',
            'country_code' => 'US',
            'currency_icon' => '$',
            'is_default' => 'yes',
            'currency_rate' => 1,
            'currency_position' => 'before_price',
            'status' => 'active',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multi_currencies');
    }
};

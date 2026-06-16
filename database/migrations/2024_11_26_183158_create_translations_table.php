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
        Schema::create('translations', function (Blueprint $table) {
            $table->id(); // auto-incrementing id
            $table->string('translatable_type', 50); // either 'category' or 'post'
            $table->integer('translatable_id'); // reference to the respective table's ID
            $table->string('lang_code', 10); // language code, e.g., 'en', 'es'
            $table->string('key', 255); // translation key (e.g., 'title', 'description')
            $table->text('value'); // translated value
            $table->timestamps(0); // created_at and updated_at with no microsecond precision
            $table->unique(['translatable_type', 'translatable_id', 'lang_code', 'key'], 'unique_translation'); // unique constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};

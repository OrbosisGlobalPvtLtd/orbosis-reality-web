<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_apps', function (Blueprint $table) {
            $table->id();
            $table->string('splash_screen')->nullable();
            $table->string('onboarding_one_title')->nullable();
            $table->string('onboarding_one_description')->nullable();
            $table->string('onboarding_one_icon')->nullable();
            $table->string('onboarding_two_title')->nullable();
            $table->string('onboarding_two_description')->nullable();
            $table->string('onboarding_two_icon')->nullable();
            $table->string('onboarding_three_title')->nullable();
            $table->string('onboarding_three_description')->nullable();
            $table->string('onboarding_three_icon')->nullable();
            $table->string('login_bg_image')->nullable();
            $table->string('login_page_logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobile_apps');
    }
};

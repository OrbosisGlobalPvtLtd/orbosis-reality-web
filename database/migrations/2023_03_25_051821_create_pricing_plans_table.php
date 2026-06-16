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
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name');
            $table->string('plan_slug');
            $table->double('plan_price');
            $table->string('plan_type');
            $table->string('expired_time');
            $table->integer('number_of_property')->default(0);
            $table->string('featured_property');
            $table->integer('featured_property_qty')->default(0);
            $table->string('top_property');
            $table->integer('top_property_qty')->default(0);
            $table->string('urgent_property');
            $table->integer('urgent_property_qty')->default(0);
            $table->integer('serial');
            $table->string('status')->default(0);
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
        Schema::dropIfExists('pricing_plans');
    }
};

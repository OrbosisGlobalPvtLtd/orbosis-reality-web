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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->integer('agent_id')->default(0);
            $table->integer('property_type_id');
            $table->integer('city_id');

            $table->text('title');
            $table->text('slug');
            $table->string('purpose');
            $table->string('rent_period')->nullable();
            $table->string('price');
            $table->string('thumbnail_image');
            $table->longText('description');
            $table->text('video_description')->nullable();
            $table->string('video_thumbnail')->nullable();
            $table->string('video_id')->nullable();

            $table->text('address');
            $table->text('address_description');
            $table->text('google_map');

            $table->string('total_area')->nullable();
            $table->string('total_unit')->nullable();
            $table->string('total_bedroom')->nullable();
            $table->string('total_bathroom')->nullable();
            $table->string('total_garage')->nullable();
            $table->string('total_kitchen')->nullable();

            $table->string('is_featured')->default('disable');
            $table->string('is_top')->default('disable');
            $table->string('is_urgent')->default('disable');
            $table->string('status')->default('disable');

            $table->date('expired_date')->nullable();

            $table->text('seo_title')->nullable();
            $table->text('seo_meta_description')->nullable();

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
        Schema::dropIfExists('properties');
    }
};


// new table

// property slider, proeprty plan, Nearest Place , Aminities

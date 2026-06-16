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
        Schema::create('homepages', function (Blueprint $table) {
            $table->id();
            $table->string('show_category')->default('enable');
            $table->string('category_item')->default(0);
            $table->string('location_title');
            $table->string('location_description');
            $table->string('show_location')->default('enable');
            $table->string('show_about_us')->default('enable');
            $table->string('property_title');
            $table->string('property_description');
            $table->string('show_property')->default('enable');
            $table->string('property_item')->default(0);
            $table->string('why_choose_title');
            $table->string('why_choose_description');
            $table->string('show_why_choose_us')->default('enable');
            $table->string('agent_title');
            $table->string('agent_description');
            $table->string('agent_item')->default(0);
            $table->string('show_agent')->default('enable');
            $table->string('home2_agent_bg');
            $table->string('show_faq')->default('enable');
            $table->string('show_mobile_app')->default('enable');
            $table->string('testimonial_title');
            $table->string('testimonial_description');
            $table->string('testimonial_item')->default(0);
            $table->string('show_testimonial')->default('enable');
            $table->string('partner_title');
            $table->string('partner_item')->default(0);
            $table->string('show_partner')->default('enable');
            $table->string('show_counter')->default('enable');
            $table->string('show_blog')->default('enable');
            $table->string('blog_item')->default(0);
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
        Schema::dropIfExists('homepages');
    }
};

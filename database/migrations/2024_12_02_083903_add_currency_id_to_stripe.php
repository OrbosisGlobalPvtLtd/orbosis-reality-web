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
        Schema::table('stripe_payments', function (Blueprint $table) {
            $table->integer('currency_id')->default(1);
        });

        Schema::table('paypal_payments', function (Blueprint $table) {
            $table->integer('currency_id')->default(1);
        });

        Schema::table('razorpay_payments', function (Blueprint $table) {
            $table->integer('currency_id')->default(1);
        });

        Schema::table('flutterwaves', function (Blueprint $table) {
            $table->integer('currency_id')->default(1);
        });


        Schema::table('paystack_and_mollies', function (Blueprint $table) {
            $table->integer('paystack_currency_id')->default(1);
            $table->integer('mollie_currency_id')->default(1);
        });

        Schema::table('instamojo_payments', function (Blueprint $table) {
            $table->integer('currency_id')->default(1);
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stripe_payments', function (Blueprint $table) {
            $table->dropColumn('currency_id');
        });

        Schema::table('paypal_payments', function (Blueprint $table) {
            $table->dropColumn('currency_id');
        });

        Schema::table('razorpay_payments', function (Blueprint $table) {
            $table->dropColumn('currency_id');
        });

        Schema::table('flutterwaves', function (Blueprint $table) {
            $table->dropColumn('currency_id');
        });

        Schema::table('paystack_and_mollies', function (Blueprint $table) {
            $table->dropColumn('paystack_currency_id');
            $table->dropColumn('mollie_currency_id');
        });

        Schema::table('instamojo_payments', function (Blueprint $table) {
            $table->dropColumn('currency_id');
        });


    }
};

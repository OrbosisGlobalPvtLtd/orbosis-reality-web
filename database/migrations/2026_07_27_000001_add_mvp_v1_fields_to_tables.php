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
        if (Schema::hasTable('pricing_plans')) {
            Schema::table('pricing_plans', function (Blueprint $table) {
                if (!Schema::hasColumn('pricing_plans', 'is_featured_badge_allowed')) {
                    $table->tinyInteger('is_featured_badge_allowed')->default(0)->after('serial');
                }
            });
        }

        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'aadhaar_number')) {
                    $table->string('aadhaar_number')->nullable();
                }
                if (!Schema::hasColumn('users', 'pan_number')) {
                    $table->string('pan_number')->nullable();
                }
                if (!Schema::hasColumn('users', 'bank_name')) {
                    $table->string('bank_name')->nullable();
                }
                if (!Schema::hasColumn('users', 'account_number')) {
                    $table->string('account_number')->nullable();
                }
                if (!Schema::hasColumn('users', 'ifsc_code')) {
                    $table->string('ifsc_code')->nullable();
                }
                if (!Schema::hasColumn('users', 'upi_id')) {
                    $table->string('upi_id')->nullable();
                }
                if (!Schema::hasColumn('users', 'office_address')) {
                    $table->text('office_address')->nullable();
                }
                if (!Schema::hasColumn('users', 'rera_number')) {
                    $table->string('rera_number')->nullable();
                }
            });
        }

        if (Schema::hasTable('properties')) {
            Schema::table('properties', function (Blueprint $table) {
                if (!Schema::hasColumn('properties', 'property_status_state')) {
                    $table->string('property_status_state')->default('pending')->after('availability_status');
                }
                if (!Schema::hasColumn('properties', 'views_count')) {
                    $table->unsignedBigInteger('views_count')->default(0)->after('property_status_state');
                }
            });
        }

        if (!Schema::hasTable('property_reports')) {
            Schema::create('property_reports', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('property_id');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('reason');
                $table->text('comments')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('notifications')) {
            Schema::create('notifications', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('type');
                $table->morphs('notifiable');
                $table->text('data');
                $table->timestamp('read_at')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('pricing_plans')) {
            Schema::table('pricing_plans', function (Blueprint $table) {
                if (Schema::hasColumn('pricing_plans', 'is_featured_badge_allowed')) {
                    $table->dropColumn('is_featured_badge_allowed');
                }
            });
        }

        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn([
                    'aadhaar_number', 'pan_number', 'bank_name',
                    'account_number', 'ifsc_code', 'upi_id',
                    'office_address', 'rera_number'
                ]);
            });
        }

        if (Schema::hasTable('properties')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->dropColumn(['property_status_state', 'views_count']);
            });
        }

        Schema::dropIfExists('property_reports');
        Schema::dropIfExists('notifications');
    }
};

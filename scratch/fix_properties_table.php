<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

Schema::table('properties', function (Blueprint $table) {
    if (!Schema::hasColumn('properties', 'show_slider')) {
        $table->string('show_slider')->default('disable')->nullable();
    }
    if (!Schema::hasColumn('properties', 'serial')) {
        $table->integer('serial')->default(0)->nullable();
    }
    if (!Schema::hasColumn('properties', 'approve_by_admin')) {
        $table->string('approve_by_admin')->default('approved')->nullable();
    }
    if (!Schema::hasColumn('properties', 'availability_status')) {
        $table->string('availability_status')->default('available')->nullable();
    }
    if (!Schema::hasColumn('properties', 'country_id')) {
        $table->unsignedBigInteger('country_id')->nullable();
    }
    if (!Schema::hasColumn('properties', 'lat')) {
        $table->string('lat')->nullable();
    }
    if (!Schema::hasColumn('properties', 'lon')) {
        $table->string('lon')->nullable();
    }
});

echo "Properties table columns updated!\n";

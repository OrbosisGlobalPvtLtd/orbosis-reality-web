<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

Schema::table('orders', function (Blueprint $table) {
    if (!Schema::hasColumn('orders', 'agent_id')) {
        $table->integer('agent_id')->default(0)->nullable();
    }
    if (!Schema::hasColumn('orders', 'pricing_plan_id')) {
        $table->integer('pricing_plan_id')->default(0)->nullable();
    }
    if (!Schema::hasColumn('orders', 'purchase_date')) {
        $table->string('purchase_date')->nullable();
    }
    if (!Schema::hasColumn('orders', 'expired_date')) {
        $table->string('expired_date')->nullable();
    }
});

echo "Orders table columns updated!\n";

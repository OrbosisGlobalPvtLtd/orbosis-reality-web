<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

Schema::table('settings', function (Blueprint $table) {
    if (!Schema::hasColumn('settings', 'selected_theme')) {
        $table->integer('selected_theme')->default(0)->nullable();
    }
    if (!Schema::hasColumn('settings', 'preloader_status')) {
        $table->integer('preloader_status')->default(1)->nullable();
    }
    if (!Schema::hasColumn('settings', 'property_auto_approval')) {
        $table->integer('property_auto_approval')->default(1)->nullable();
    }
    if (!Schema::hasColumn('settings', 'app_name')) {
        $table->string('app_name')->default('Orbosis Reality')->nullable();
    }
    if (!Schema::hasColumn('settings', 'currency_name')) {
        $table->string('currency_name')->default('USD')->nullable();
    }
    if (!Schema::hasColumn('settings', 'currency_icon')) {
        $table->string('currency_icon')->default('$')->nullable();
    }
    if (!Schema::hasColumn('settings', 'default_avatar')) {
        $table->string('default_avatar')->nullable();
    }
    if (!Schema::hasColumn('settings', 'theme_one_color')) {
        $table->string('theme_one_color')->nullable();
    }
    if (!Schema::hasColumn('settings', 'theme_two_color')) {
        $table->string('theme_two_color')->nullable();
    }
});

echo "Settings table columns updated!\n";

if (DB::table('settings')->count() === 0) {
    DB::table('settings')->insert([
        'id' => 1,
        'app_name' => 'Orbosis Reality',
        'selected_theme' => 0,
        'enable_user_register' => 1,
        'enable_multivendor' => 1,
        'text_direction' => 'LTR',
        'timezone' => 'Asia/Kolkata',
        'currency_name' => 'USD',
        'currency_icon' => '$',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    echo "Default setting row inserted!\n";
}

<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

// MAINTAINANCE TEXTS
Schema::table('maintainance_texts', function (Blueprint $table) {
    if (!Schema::hasColumn('maintainance_texts', 'status')) {
        $table->integer('status')->default(0)->nullable();
    }
    if (!Schema::hasColumn('maintainance_texts', 'image')) {
        $table->string('image')->nullable();
    }
    if (!Schema::hasColumn('maintainance_texts', 'description')) {
        $table->text('description')->nullable();
    }
});

if (DB::table('maintainance_texts')->count() === 0) {
    DB::table('maintainance_texts')->insert([
        'id' => 1,
        'status' => 0,
        'description' => 'Site under maintenance.',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    echo "Default maintainance_text created!\n";
}

// ABOUT US
if (DB::table('about_us')->count() === 0) {
    DB::table('about_us')->insert([
        'id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    echo "Default about_us created!\n";
}

// CONTACT PAGES
if (DB::table('contact_pages')->count() === 0) {
    DB::table('contact_pages')->insert([
        'id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    echo "Default contact_page created!\n";
}

echo "All singleton tables seeded successfully!\n";

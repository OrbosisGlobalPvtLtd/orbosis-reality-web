<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;

echo "Settings columns: " . implode(', ', Schema::getColumnListing('settings')) . "\n\n";
echo "MobileApps columns: " . implode(', ', Schema::getColumnListing('mobile_apps')) . "\n\n";
echo "AboutUs columns: " . implode(', ', Schema::getColumnListing('about_uses')) . "\n\n";

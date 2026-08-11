<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Setting;

$setting = Setting::first();
if ($setting) {
    $setting->default_avatar = 'uploads/website-images/default-avatar-2023-03-29-01-15-19-5787.jpg';
    $setting->default_placeholder = 'uploads/website-images/city-2026-01-10-06-50-10-1272.webp';
    $setting->save();
    echo "Updated default_avatar and default_placeholder in Setting.\n";
}

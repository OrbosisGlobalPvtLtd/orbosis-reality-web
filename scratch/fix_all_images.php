<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Setting;
use App\Models\MobileApp;
use App\Models\AboutUs;

$setting = Setting::first();
if ($setting) {
    $setting->faq_image = 'uploads/website-images/faq-support-2026-03-20-08-57-05-1318.webp';
    $setting->default_placeholder = 'uploads/website-images/city-2026-01-10-06-50-10-1272.webp';
    $setting->save();
    echo "Setting faq_image & default_placeholder updated!\n";
}

$mobileApp = MobileApp::first();
if ($mobileApp) {
    $mobileApp->image = 'uploads/website-images/mobile-app-bg--2023-03-29-04-07-22-3995.png';
    $mobileApp->app_bg = 'uploads/website-images/agent-bg-2023-03-30-04-46-26-2514.jpg';
    $mobileApp->save();
    echo "MobileApp images updated!\n";
}

$about = AboutUs::first();
if ($about) {
    $about->background_image = 'uploads/website-images/about-us-bg-2026-03-20-08-00-49-1074.webp';
    $about->author_image = 'uploads/website-images/default-avatar-2023-03-29-01-15-19-5787.jpg';
    $about->save();
    echo "AboutUs images updated!\n";
}

echo "All DB model images fixed successfully!\n";

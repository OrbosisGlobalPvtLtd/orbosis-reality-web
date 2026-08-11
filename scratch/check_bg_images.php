<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\WhyChooseUs;
use App\Models\MobileApp;
use App\Models\Testimonial;
use App\Models\Setting;
use App\Models\Counter;

echo "MobileApp bg: " . (MobileApp::first() ? MobileApp::first()->app_bg : 'null') . "\n";
echo "Setting login_bg_image: " . (Setting::first() ? Setting::first()->login_bg_image : 'null') . "\n";

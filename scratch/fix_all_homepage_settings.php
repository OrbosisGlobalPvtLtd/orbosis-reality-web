<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Homepage;
use App\Models\Faq;
use App\Models\Footer;
use App\Models\Setting;

$hp = Homepage::first();
if ($hp) {
    $hp->property_item = 6;
    $hp->agent_item = 6;
    $hp->show_property = 'enable';
    $hp->show_location = 'enable';
    $hp->show_about_us = 'enable';
    $hp->show_why_choose_us = 'enable';
    $hp->show_agent = 'enable';
    $hp->location_title = 'Indore Real Estate Hubs';
    $hp->location_description = 'Explore Top Locations & Areas in Indore';
    $hp->property_title = 'Featured Properties in Indore';
    $hp->property_description = 'Handpicked Residential & Commercial Properties';
    $hp->why_choose_title = 'Why Choose Orbosis Reality';
    $hp->why_choose_description = 'Your Most Trusted Real Estate Partner in Indore';
    $hp->save();
    echo "Homepage settings updated!\n";
}

$setting = Setting::first();
if ($setting) {
    $setting->agent_can_add_property = 'enable';
    $setting->save();
    echo "Setting agent_can_add_property updated!\n";
}

echo "Database config done.\n";

<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Homepage;
use App\Models\Property;

$hp = Homepage::first();
echo "show_property: " . ($hp ? $hp->show_property : 'null') . "\n";
echo "property_item: " . ($hp ? $hp->property_item : 'null') . "\n";

if ($hp) {
    $hp->property_item = 6;
    $hp->show_property = 'enable';
    $hp->show_location = 'enable';
    $hp->show_about_us = 'enable';
    $hp->show_why_choose_us = 'enable';
    $hp->show_agent = 'enable';
    $hp->save();
    echo "Updated Homepage setting: property_item = 6, show_property = enable\n";
}

$props = Property::where('status', 'enable')
    ->where('is_featured', 'enable')
    ->where('approve_by_admin', 'approved')
    ->get();

echo "Featured Properties Count in DB: " . $props->count() . "\n";
foreach ($props as $p) {
    echo "- ID: {$p->id} | {$p->title} | thumb: {$p->thumbnail_image}\n";
}

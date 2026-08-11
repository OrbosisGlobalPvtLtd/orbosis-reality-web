<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\City;
use App\Models\AboutUs;
use App\Models\Property;

$validCityImages = [
    'uploads/website-images/city-2026-01-10-06-50-10-1272.webp',
    'uploads/website-images/city-2023-04-09-01-40-19-2020.webp',
    'uploads/website-images/city-2023-04-09-01-48-20-8203.webp',
    'uploads/website-images/city-2023-04-09-02-50-26-3352.webp',
    'uploads/website-images/city-2023-04-09-02-50-48-7275.webp',
    'uploads/website-images/city-2023-04-09-02-58-59-6207.webp',
    'uploads/website-images/city-2023-04-09-02-59-26-2757.webp',
    'uploads/website-images/about-us-bg-2026-03-20-08-00-49-1074.webp',
    'uploads/website-images/home2-about-us1-2023-03-30-10-04-07-7272.webp'
];

$cities = City::all();
foreach ($cities as $i => $city) {
    $city->image = $validCityImages[$i % count($validCityImages)];
    $city->save();
}
echo "Updated " . count($cities) . " cities with verified webp images.\n";

$about = AboutUs::first();
if ($about) {
    $about->background_image = 'uploads/website-images/about-us-bg-2026-03-20-08-00-49-1074.webp';
    $about->author_image = 'uploads/website-images/author-image-2026-03-20-08-47-10-6534.webp';
    $about->save();
    echo "Updated AboutUs images.\n";
}

$props = Property::all();
foreach ($props as $i => $p) {
    $p->thumbnail_image = $validCityImages[$i % count($validCityImages)];
    $p->status = 'enable';
    $p->is_featured = 'enable';
    $p->approve_by_admin = 'approved';
    $p->save();
}
echo "Updated " . count($props) . " properties with verified webp thumbnails.\n";

echo "All images updated successfully!\n";

<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\WhyChooseUs;
use App\Models\Footer;

WhyChooseUs::truncate();

$items = [
    [
        'icon' => 'uploads/website-images/trusted20230409043232.svg',
        'title' => '100% Verified Properties',
        'description' => 'Every plot, flat, and commercial space in Indore is physically verified for clean titles.',
    ],
    [
        'icon' => 'uploads/website-images/247-support20230409043339.svg',
        'title' => '24/7 Dedicated Support',
        'description' => 'Our expert real estate advisors guide you at every step of buying or renting.',
    ],
    [
        'icon' => 'uploads/website-images/financing-easy20230409043353.svg',
        'title' => 'Transparent Documentation',
        'description' => 'Zero hidden charges, clear legal documentation, and hassle-free registry assistance.',
    ],
    [
        'icon' => 'uploads/website-images/wide-range-house20230409043411.svg',
        'title' => 'Prime Indore Locations',
        'description' => 'Properties in Vijay Nagar, Nipania, Palasia, Super Corridor, and top hubs.',
    ],
];

foreach ($items as $item) {
    $w = new WhyChooseUs();
    $w->icon = $item['icon'];
    $w->title = $item['title'];
    $w->description = $item['description'];
    $w->save();
    echo "Added WhyChooseUs item: {$item['title']}\n";
}

$footer = Footer::first();
if (!$footer) {
    $footer = new Footer();
}
$footer->email = 'info@orbosis.com';
$footer->phone = '+91 9875643210';
$footer->address = 'AB Road, Vijay Nagar, Indore, MP 452010';
$footer->save();
echo "Footer model updated!\n";

<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\WhyChooseUs;
use App\Models\Footer;
use App\Models\Counter;

$w = WhyChooseUs::first();
if (!$w) {
    $w = new WhyChooseUs();
}
$w->visibility = 1;
$w->title = 'Why Choose Orbosis Reality';
$w->description = 'Your Most Trusted Real Estate Partner in Indore';
$w->icon_1 = 'uploads/website-images/trusted20230409043232.svg';
$w->title_1 = '100% Verified Properties';
$w->description_1 = 'Every plot, flat, and commercial space in Indore is physically verified for clean titles.';

$w->icon_2 = 'uploads/website-images/247-support20230409043339.svg';
$w->title_2 = '24/7 Dedicated Support';
$w->description_2 = 'Our expert real estate advisors guide you at every step of buying or renting.';

$w->icon_3 = 'uploads/website-images/financing-easy20230409043353.svg';
$w->title_3 = 'Transparent Documentation';
$w->description_3 = 'Zero hidden charges, clear legal documentation, and hassle-free registry assistance.';

$w->icon_4 = 'uploads/website-images/wide-range-house20230409043411.svg';
$w->title_4 = 'Prime Indore Locations';
$w->description_4 = 'Properties in Vijay Nagar, Nipania, Palasia, Super Corridor, and top hubs.';
$w->save();
echo "WhyChooseUs model populated successfully!\n";

$footer = Footer::first();
if (!$footer) {
    $footer = new Footer();
}
$footer->email = 'orbosisrealtyofficial@gmail.com';
$footer->phone = '+91 9039524109';
$footer->address = '3 floor mbience cafe Sector A, Mahalaxmi Nagar, Indore, Madhya Pradesh 452010';
$footer->copyright = '© 2026 Orbosis Reality. All Rights Reserved.';
$footer->footer_left_title = 'Orbosis Realty';
$footer->footer_left_description = 'Indore\'s leading real estate platform for residential and commercial properties.';
$footer->save();
echo "Footer model updated successfully!\n";

echo "Done seeding missing sections!\n";

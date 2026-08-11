<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\AboutUs;

$about = AboutUs::first();
if ($about) {
    echo "background_image: {$about->background_image}\n";
    echo "author_image: {$about->author_image}\n";
    echo "item1_icon: {$about->item1_icon}\n";
    echo "item2_icon: {$about->item2_icon}\n";
}

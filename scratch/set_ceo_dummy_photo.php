<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\AboutUs;

$about = AboutUs::first();
if ($about) {
    $about->author_image = 'uploads/website-images/john-doe-2023-04-02-12-13-26-4519.jpg';
    $about->save();
    echo "Updated AboutUs author_image to john-doe-2023-04-02-12-13-26-4519.jpg\n";
}

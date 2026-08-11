<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Blog;

$blogs = Blog::all();
$validImages = [
    'uploads/custom-images/blog--2023-05-07-10-36-45-7664.jpg',
    'uploads/custom-images/blog--2023-05-07-10-39-20-9283.jpg',
    'uploads/custom-images/blog--2023-05-07-10-42-26-7161.jpg',
];

foreach ($blogs as $idx => $b) {
    $img = $validImages[$idx % count($validImages)];
    $b->image = $img;
    $b->save();
    echo "Updated Blog ID {$b->id} image to: {$img}\n";
}

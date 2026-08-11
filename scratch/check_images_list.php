<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$files = scandir(public_path('uploads/website-images'));
print_r(array_filter($files, function($f) {
    return str_contains($f, '.png') || str_contains($f, '.jpg') || str_contains($f, '.webp');
}));

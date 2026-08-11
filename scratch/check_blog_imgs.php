<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Blog;

foreach (Blog::all() as $b) {
    echo "ID {$b->id}: {$b->image} => " . (file_exists(public_path($b->image)) ? 'EXISTS' : 'NOT FOUND') . "\n";
}

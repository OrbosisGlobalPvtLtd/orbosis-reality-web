<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Homepage;

$h = Homepage::first();
if ($h) {
    $h->blog_item = 6;
    $h->show_blog = 'enable';
    $h->save();
    echo "Updated Homepage blog_item = 6, show_blog = enable!\n";
}

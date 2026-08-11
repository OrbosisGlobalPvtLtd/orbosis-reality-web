<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Homepage;

$h = Homepage::first();
if ($h) {
    $h->blog_item = 3;
    $h->show_blog = 'enable';
    $h->blog_title = 'Indore Real Estate Insights';
    $h->blog_description = 'Latest News & Market Trends in Indore MP';
    $h->save();
    echo "Updated Homepage blog_item = 3, show_blog = enable successfully!\n";
}

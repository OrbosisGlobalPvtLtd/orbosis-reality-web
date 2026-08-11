<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\WhyChooseUs;

$w = WhyChooseUs::first();
if ($w) {
    echo "visibility: {$w->visibility}\n";
    echo "title: {$w->title}\n";
    echo "description: {$w->description}\n";
    echo "items count: " . (is_array($w->items) || is_object($w->items) ? count($w->items) : 'not countable') . "\n";
    print_r($w->items);
}

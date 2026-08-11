<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$paginations = App\Models\CustomPagination::all();
echo "CustomPaginations count: " . $paginations->count() . "\n";
print_r($paginations->toArray());

<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\CustomPagination;

$items = [
    ['id' => 1, 'page_name' => 'Blog Page', 'qty' => 9],
    ['id' => 2, 'page_name' => 'Property Page', 'qty' => 12],
    ['id' => 3, 'page_name' => 'Agent Page', 'qty' => 12],
    ['id' => 4, 'page_name' => 'Blog Comment', 'qty' => 10],
];

foreach ($items as $item) {
    CustomPagination::updateOrCreate(['id' => $item['id']], $item);
}

echo "CustomPaginations seeded successfully.\n";
print_r(CustomPagination::all()->toArray());

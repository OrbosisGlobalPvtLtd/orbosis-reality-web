<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

echo "blogs columns: " . implode(', ', Schema::getColumnListing('blogs')) . "\n";
echo "blog_categories columns: " . implode(', ', Schema::getColumnListing('blog_categories')) . "\n";

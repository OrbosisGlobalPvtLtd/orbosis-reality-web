<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Blog;
use App\Models\BlogCategory;

Blog::truncate();
BlogCategory::truncate();

$cat = new BlogCategory();
$cat->name = 'Indore Real Estate News';
$cat->slug = 'indore-real-estate-news';
$cat->status = 1;
$cat->save();

$blogsData = [
    [
        'title' => 'Top 5 Real Estate Investment Hotspots in Indore for 2026',
        'slug' => 'top-5-real-estate-investment-hotspots-indore-2026',
        'image' => 'uploads/website-images/luxury_villa.png',
        'description' => 'Discover why Vijay Nagar, Nipania, and Super Corridor are driving high ROI for residential & commercial property investors in Indore, MP.',
    ],
    [
        'title' => 'Complete Guide to Property Registry & Stamp Duty in Indore MP',
        'slug' => 'guide-to-property-registry-stamp-duty-indore-mp',
        'image' => 'uploads/website-images/modern_apartment.png',
        'description' => 'A comprehensive step-by-step guide to land registration, e-Stamping, and property mutation charges across Indore development zones.',
    ],
    [
        'title' => 'Why Super Corridor Indore is the Next Big Commercial Hub',
        'slug' => 'why-super-corridor-indore-is-the-next-big-commercial-hub',
        'image' => 'uploads/website-images/commercial_building.png',
        'description' => 'Exploring upcoming IT parks, Metro connectivity, and commercial retail expansion along Indore\'s famous Super Corridor belt.',
    ],
];

foreach ($blogsData as $b) {
    $blog = new Blog();
    $blog->admin_id = 1;
    $blog->title = $b['title'];
    $blog->slug = $b['slug'];
    $blog->blog_category_id = $cat->id;
    $blog->image = $b['image'];
    $blog->description = $b['description'];
    $blog->views = rand(120, 850);
    $blog->status = 1;
    $blog->show_homepage = 1;
    $blog->save();
    echo "Seeded Indore Blog: {$b['title']}\n";
}

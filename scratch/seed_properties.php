<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Property;
use App\Models\City;
use App\Models\Category;
use App\Models\User;

$city = City::first();
$category = Category::first();
$user = User::first();

$sampleProperties = [
    [
        'title' => 'Modern 3BHK Luxury Apartment in Vijay Nagar',
        'slug' => 'modern-3bhk-luxury-apartment-vijay-nagar',
        'purpose' => 'sale',
        'rent_period' => null,
        'price' => 8500000,
        'thumbnail_image' => 'uploads/website-images/luxury_villa.png',
        'address' => 'Vijay Nagar, AB Road, Indore, MP',
        'total_bedroom' => 3,
        'total_bathroom' => 3,
        'total_area' => 1850,
        'status' => 'enable',
        'is_featured' => 'enable',
        'approve_by_admin' => 'approved',
        'availability_status' => 'available',
        'show_slider' => 'enable',
        'serial' => 1,
    ],
    [
        'title' => 'Executive Villa with Swimming Pool & Garden',
        'slug' => 'executive-villa-swimming-pool-garden',
        'purpose' => 'sale',
        'rent_period' => null,
        'price' => 14500000,
        'thumbnail_image' => 'uploads/website-images/modern_apartment.png',
        'address' => 'Nipania Main Road, Indore, MP',
        'total_bedroom' => 4,
        'total_bathroom' => 4,
        'total_area' => 3200,
        'status' => 'enable',
        'is_featured' => 'enable',
        'approve_by_admin' => 'approved',
        'availability_status' => 'available',
        'show_slider' => 'enable',
        'serial' => 2,
    ],
    [
        'title' => 'Premium Commercial Office Space in Palasia',
        'slug' => 'premium-commercial-office-space-palasia',
        'purpose' => 'rent',
        'rent_period' => 'month',
        'price' => 65000,
        'thumbnail_image' => 'uploads/website-images/commercial_building.png',
        'address' => 'Old Palasia, Near Industry House, Indore, MP',
        'total_bedroom' => 2,
        'total_bathroom' => 2,
        'total_area' => 1400,
        'status' => 'enable',
        'is_featured' => 'enable',
        'approve_by_admin' => 'approved',
        'availability_status' => 'available',
        'show_slider' => 'enable',
        'serial' => 3,
    ],
    [
        'title' => 'Contemporary 2BHK Furnished Flat near Geeta Bhawan',
        'slug' => 'contemporary-2bhk-furnished-flat-geeta-bhawan',
        'purpose' => 'rent',
        'rent_period' => 'month',
        'price' => 28000,
        'thumbnail_image' => 'uploads/website-images/city-2026-01-10-06-50-10-1272.webp',
        'address' => 'Geeta Bhawan Square, Indore, MP',
        'total_bedroom' => 2,
        'total_bathroom' => 2,
        'total_area' => 1100,
        'status' => 'enable',
        'is_featured' => 'enable',
        'approve_by_admin' => 'approved',
        'availability_status' => 'available',
        'show_slider' => 'enable',
        'serial' => 4,
    ],
    [
        'title' => 'Spacious 4BHK Independent House in Saket Nagar',
        'slug' => 'spacious-4bhk-independent-house-saket-nagar',
        'purpose' => 'sale',
        'rent_period' => null,
        'price' => 11200000,
        'thumbnail_image' => 'uploads/website-images/luxury_villa.png',
        'address' => 'Saket Nagar Block B, Indore, MP',
        'total_bedroom' => 4,
        'total_bathroom' => 4,
        'total_area' => 2600,
        'status' => 'enable',
        'is_featured' => 'enable',
        'approve_by_admin' => 'approved',
        'availability_status' => 'available',
        'show_slider' => 'enable',
        'serial' => 5,
    ],
    [
        'title' => 'Luxury Duplex Villa near Super Corridor',
        'slug' => 'luxury-duplex-villa-super-corridor',
        'purpose' => 'sale',
        'rent_period' => null,
        'price' => 9800000,
        'thumbnail_image' => 'uploads/website-images/modern_apartment.png',
        'address' => 'Super Corridor Highway, Indore, MP',
        'total_bedroom' => 3,
        'total_bathroom' => 3,
        'total_area' => 2100,
        'status' => 'enable',
        'is_featured' => 'enable',
        'approve_by_admin' => 'approved',
        'availability_status' => 'available',
        'show_slider' => 'enable',
        'serial' => 6,
    ],
];

foreach ($sampleProperties as $data) {
    try {
        $p = new Property();
        foreach ($data as $key => $val) {
            $p->$key = $val;
        }
        if ($city) $p->city_id = $city->id;
        if ($category) $p->property_type_id = $category->id;
        if ($user) $p->agent_id = $user->id;
        $p->save();
        echo "Created property: {$data['title']}\n";
    } catch (\Exception $e) {
        echo "Failed creating {$data['title']}: " . $e->getMessage() . "\n";
    }
}

echo "Seeding completed successfully!\n";

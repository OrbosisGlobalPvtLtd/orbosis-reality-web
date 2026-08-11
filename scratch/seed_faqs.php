<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Faq;
use App\Models\Setting;

Faq::truncate();

$items = [
    [
        'question' => 'How do I buy or book a property in Indore with Orbosis Reality?',
        'ans' => 'You can browse our verified residential and commercial listings in Indore, request a site visit, or contact our dedicated property advisors directly through our portal.',
    ],
    [
        'question' => 'Are all properties listed on Orbosis Reality physically verified?',
        'ans' => 'Yes, every listing in Vijay Nagar, Nipania, Palasia, Super Corridor, and Saket Nagar undergoes rigorous physical verification and legal title checks before going live.',
    ],
    [
        'question' => 'What documentation assistance does Orbosis Reality provide?',
        'ans' => 'We assist buyers and sellers with registry, mutation, legal agreements, bank loan processing, and clear title verification with complete transparency.',
    ],
    [
        'question' => 'Can I list my property for sale or rent on Orbosis Reality?',
        'ans' => 'Absolutely! Owners and agents can click on "Create Property" in the top navigation to submit property details for verification and listing.',
    ],
];

foreach ($items as $item) {
    $f = new Faq();
    $f->question = $item['question'];
    $f->ans = $item['ans'];
    $f->status = 1;
    $f->save();
    echo "Added FAQ: {$item['question']}\n";
}

$s = Setting::first();
if ($s) {
    $s->faq_short_title = 'Frequently Asked Questions';
    $s->faq_long_title = 'Everything You Need To Know About Buying Property in Indore';
    $s->faq_image = 'uploads/website-images/faq-support-2026-03-20-08-57-05-1318.webp';
    $s->faq_support_time = '24/7 Support';
    $s->faq_support_title = 'Dedicated Property Helpline';
    $s->save();
    echo "Updated Setting FAQ fields successfully!\n";
}

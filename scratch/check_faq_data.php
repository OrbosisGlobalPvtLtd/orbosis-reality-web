<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Faq;

$faq = Faq::first();
echo "Faq model: " . ($faq ? 'exists' : 'null') . "\n";
if ($faq) {
    echo "Faq title: " . $faq->title . "\n";
    echo "Faq description: " . $faq->description . "\n";
}

$faqItems = \App\Models\FaqItem::all();
echo "FaqItems count: " . count($faqItems) . "\n";
foreach ($faqItems as $i) {
    echo " - " . $i->question . "\n";
}

<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Setting;

$s = Setting::first();
if ($s) {
    echo "footer_logo: " . $s->footer_logo . "\n";
    if (empty($s->footer_logo) || !file_exists(public_path($s->footer_logo))) {
        $s->footer_logo = 'uploads/website-images/logo-2026-01-10-05-02-59-8516.png';
        $s->save();
        echo "Updated footer_logo to uploads/website-images/logo-2026-01-10-05-02-59-8516.png\n";
    }
}

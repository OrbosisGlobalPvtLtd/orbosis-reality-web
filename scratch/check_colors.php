<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Setting;

$s = Setting::first();
echo "theme_one_color: '" . ($s ? $s->theme_one_color : '') . "'\n";
echo "theme_two_color: '" . ($s ? $s->theme_two_color : '') . "'\n";
echo "logo: '" . ($s ? $s->logo : '') . "'\n";
echo "favicon: '" . ($s ? $s->favicon : '') . "'\n";

if ($s) {
    if (empty($s->theme_one_color)) $s->theme_one_color = '#6366f1';
    if (empty($s->theme_two_color)) $s->theme_two_color = '#0f172a';
    if (empty($s->logo) || !file_exists(public_path($s->logo))) $s->logo = 'uploads/website-images/logo-2026-01-10-05-02-59-8516.png';
    if (empty($s->favicon) || !file_exists(public_path($s->favicon))) $s->favicon = 'uploads/website-images/favicon-2026-03-20-06-06-43-7555.png';
    $s->save();
    echo "Updated theme colors & logo/favicon in Setting table!\n";
}

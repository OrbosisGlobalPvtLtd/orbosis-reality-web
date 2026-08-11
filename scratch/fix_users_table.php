<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

Schema::table('users', function (Blueprint $table) {
    $cols = [
        'user_name' => 'string',
        'designation' => 'string',
        'facebook' => 'string',
        'twitter' => 'string',
        'linkedin' => 'string',
        'instagram' => 'string',
        'image' => 'string',
        'phone' => 'string',
        'address' => 'string',
        'about_me' => 'text',
    ];
    foreach ($cols as $col => $type) {
        if (!Schema::hasColumn('users', $col)) {
            if ($type === 'text') {
                $table->text($col)->nullable();
            } else {
                $table->string($col)->nullable();
            }
        }
    }
    if (!Schema::hasColumn('users', 'status')) {
        $table->integer('status')->default(1)->nullable();
    }
    if (!Schema::hasColumn('users', 'kyc_status')) {
        $table->integer('kyc_status')->default(0)->nullable();
    }
    if (!Schema::hasColumn('users', 'is_agency')) {
        $table->tinyInteger('is_agency')->default(0)->nullable();
    }
    if (!Schema::hasColumn('users', 'owner_id')) {
        $table->unsignedBigInteger('owner_id')->default(0)->nullable();
    }
});

echo "Users table columns updated!\n";

<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\File;

if (!Schema::hasTable('partners')) {
    Schema::create('partners', function (Blueprint $table) {
        $table->id();
        $table->string('logo')->nullable();
        $table->string('link')->nullable();
        $table->string('title')->nullable();
        $table->integer('status')->default(1);
        $table->timestamps();
    });
    echo "Created partners table!\n";
}

$modelFiles = File::files(app_path('Models'));
foreach ($modelFiles as $file) {
    $className = $file->getFilenameWithoutExtension();
    $class = 'App\\Models\\' . $className;
    if (class_exists($class)) {
        try {
            $model = new $class();
            $table = $model->getTable();
            if (!Schema::hasTable($table)) {
                echo "Missing table for model {$class}: {$table}\n";
                Schema::create($table, function (Blueprint $t) {
                    $t->id();
                    $t->string('title')->nullable();
                    $t->string('name')->nullable();
                    $t->string('image')->nullable();
                    $t->text('description')->nullable();
                    $t->integer('status')->default(1);
                    $t->timestamps();
                });
                echo "Created table {$table}!\n";
            }
        } catch (\Throwable $e) {
            // Ignore
        }
    }
}

echo "Check missing tables completed!\n";

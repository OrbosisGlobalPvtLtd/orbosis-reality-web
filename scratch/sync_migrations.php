<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;

$migrationDirs = [
    database_path('migrations')
];

$moduleDirs = File::directories(base_path('Modules'));
foreach ($moduleDirs as $moduleDir) {
    $migDir = $moduleDir . '/Database/Migrations';
    if (File::exists($migDir)) {
        $migrationDirs[] = $migDir;
    }
}

$alreadyMigrated = DB::table('migrations')->pluck('migration')->toArray();

foreach ($migrationDirs as $dir) {
    $migrationFiles = File::files($dir);
    foreach ($migrationFiles as $file) {
        $filename = $file->getFilenameWithoutExtension();
        if (in_array($filename, $alreadyMigrated)) {
            continue;
        }

        $content = File::get($file->getPathname());
        
        // 1. Schema::create
        if (preg_match("/Schema::create\(['\"]([^'\"]+)['\"]/", $content, $matches)) {
            $tableName = $matches[1];
            if (Schema::hasTable($tableName)) {
                echo "Marking {$filename} as done for table {$tableName}\n";
                DB::table('migrations')->insert([
                    'migration' => $filename,
                    'batch' => 1
                ]);
                $alreadyMigrated[] = $filename;
                continue;
            }
        }

        // 2. Schema::table (adding columns)
        if (preg_match("/Schema::table\(['\"]([^'\"]+)['\"]/", $content, $matches)) {
            $tableName = $matches[1];
            if (Schema::hasTable($tableName)) {
                if (preg_match_all("/->(?:string|integer|bigInteger|unsignedBigInteger|text|enum|boolean|timestamp|date|dateTime|foreignId|tinyInteger|json|decimal|double|float)\(['\"]([^'\"]+)['\"]/", $content, $colMatches)) {
                    $allExist = true;
                    foreach ($colMatches[1] as $col) {
                        if (!Schema::hasColumn($tableName, $col)) {
                            $allExist = false;
                            break;
                        }
                    }
                    if ($allExist && count($colMatches[1]) > 0) {
                        echo "Marking column migration {$filename} as done for table {$tableName}\n";
                        DB::table('migrations')->insert([
                            'migration' => $filename,
                            'batch' => 1
                        ]);
                        $alreadyMigrated[] = $filename;
                    }
                }
            }
        }
    }
}

echo "Sync completed!\n";

<?php
require __DIR__ . '/../application/vendor/autoload.php';
$app = require_once __DIR__ . '/../application/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

$tables = DB::select('SHOW TABLES');
$reportTables = [];

foreach ($tables as $t) {
    foreach ($t as $k => $v) {
        if (strpos($v, 'information_') === 0 || strpos($v, 'reports_') === 0) {
            $reportTables[] = $v;
        }
    }
}

echo "=== Comprehensive Database Report Table Audit ===\n";
foreach ($reportTables as $table) {
    echo "Processing Table: $table\n";
    $columns = DB::select("SHOW COLUMNS FROM `$table` WHERE Type LIKE 'varchar%' OR Type LIKE 'text%' OR Type LIKE 'longtext%' OR Type LIKE 'mediumtext%'");
    
    foreach ($columns as $c) {
        $col = $c->Field;
        // Sample data that isn't empty
        $sample = DB::table($table)->whereNotNull($col)->where($col, '<>', '')->limit(1)->value($col);
        if ($sample) {
            echo "  [AUDIT] Column: $col (Type: {$c->Type})\n";
        }
    }
}

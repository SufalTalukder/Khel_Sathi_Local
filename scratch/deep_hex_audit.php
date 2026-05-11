<?php
require __DIR__ . '/../application/vendor/autoload.php';
$app = require_once __DIR__ . '/../application/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$tables = [
    "information_prashikshan" => "instructor_name",
    "information_project_under_construction" => "project_name"
];

echo "=== DEEP SCAN FOR SHIFT MAP ===\n";

foreach ($tables as $table => $col) {
    echo "\nTable: $table\n";
    $records = DB::table($table)
        ->where($col, 'LIKE', '%ऩ%')
        ->orWhere($col, 'LIKE', '%ऽ%')
        ->orWhere($col, 'LIKE', '%ीा%')
        ->limit(10)
        ->get();
        
    foreach ($records as $r) {
        $val = $r->$col;
        echo "ID: {$r->id} | Value: $val | HEX: " . bin2hex($val) . "\n";
    }
}

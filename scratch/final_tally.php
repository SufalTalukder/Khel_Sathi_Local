<?php
require __DIR__ . '/../application/vendor/autoload.php';
$app = require_once __DIR__ . '/../application/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$tables = [
    "information_prashikshan" => "instructor_name",
    "information_adhikaariyon_prashikshon" => "instructor_name",
    "information_project_under_construction" => "project_name",
    "information_pratiyogitaonkaaayojan" => "competition_name"
];

echo "=== FINAL REMAINING CORRUPTION TALLY ===\n";

foreach ($tables as $table => $col) {
    $count = DB::table($table)
        ->where($col, 'LIKE', '%ऩ%')
        ->orWhere($col, 'LIKE', '%म्%')
        ->orWhere($col, 'LIKE', '%ब्%')
        ->orWhere($col, 'LIKE', '%ीा%')
        ->count();
        
    $total = DB::table($table)->count();
    echo "Table: [$table] -> Remaining: $count / Total: $total\n";
}

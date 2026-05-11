<?php
require __DIR__ . '/../application/vendor/autoload.php';
$app = require_once __DIR__ . '/../application/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$tables = DB::select('SHOW TABLES');
$auditResults = [];

echo "=== GLOBAL HINDI CORRUPTION AUDIT ===\n";

foreach ($tables as $t) {
    $table = array_values((array)$t)[0];
    if (strpos($table, 'information_') === 0 || strpos($table, 'form_') === 0) {
        $columns = DB::select("SHOW COLUMNS FROM `$table` WHERE Type LIKE 'varchar%' OR Type LIKE 'text%'");
        $corruptedCols = [];
        
        foreach ($columns as $c) {
            $col = $c->Field;
            // Search for truly distinctive mangled patterns
            // Valid characters like 'ी' are removed to avoid false positives
            $hasMangled = DB::table($table)
                ->where($col, 'LIKE', '%ऩ%')
                ->orWhere($col, 'LIKE', '%ब्%')
                ->orWhere($col, 'LIKE', '%म्%')
                ->orWhere($col, 'LIKE', '%ीा%') // Mangled 'ra'
                ->exists();
                
            if ($hasMangled) {
                $corruptedCols[] = $col;
            }
        }
        
        if (!empty($corruptedCols)) {
            echo "MATCH FOUND: Table [$table], Columns: [" . implode(', ', $corruptedCols) . "]\n";
            $auditResults[$table] = $corruptedCols;
        }
    }
}

echo "=== AUDIT COMPLETE ===\n";
echo "Recommended Mapping for repair script:\n";
echo json_encode($auditResults, JSON_PRETTY_PRINT);

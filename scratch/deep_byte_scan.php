<?php
require __DIR__ . '/../application/vendor/autoload.php';
$app = require_once __DIR__ . '/../application/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// We need to find ONE row that the user sees as mangled.
// Try the project construction table first.
$tables = ['information_project_under_construction', 'information_prashikshan', 'information_adhikaariyon_prashikshon'];

echo "=== DEEP BYTE-LEVEL SCAN ===\n";

foreach ($tables as $table) {
    echo "Scanning $table...\n";
    $records = DB::table($table)->get();
    foreach ($records as $row) {
        $props = get_object_vars($row);
        foreach ($props as $key => $val) {
            if (is_string($val) && (strpos($val, 'ी') !== false || strpos($val, 'ऩ') !== false)) {
                echo "FOUND POTENTIAL: Table [$table], Column [$key], ID [{$row->id}]\n";
                echo "  Raw Value: $val\n";
                echo "  Hex Bytes: " . bin2hex($val) . "\n";
                
                // Test repair
                $rep = repairHindi($val);
                if ($rep === $val) {
                    echo "  [FAIL] repairHindi() did not change this value.\n";
                } else {
                    echo "  [SUCCESS] repairHindi() changed to: $rep\n";
                }
                echo "---------------------------------\n";
            }
        }
    }
}

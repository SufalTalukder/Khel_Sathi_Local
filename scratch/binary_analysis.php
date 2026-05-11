<?php
require __DIR__ . '/../application/vendor/autoload.php';
$app = require_once __DIR__ . '/../application/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== BINARY LEVEL CORRUPTION ANALYSIS ===\n";

$table = 'information_prashikshan';
$mangledChar = 'ऩ'; // Visual 'na' with dot

$row = DB::table($table)->where('instructor_name', 'LIKE', '%' . $mangledChar . '%')->first();

if ($row) {
    $val = $row->instructor_name;
    echo "Found Mangled Row: ID {$row->id}\n";
    echo "UTF-8: $val\n";
    
    // Find the position of 'ऩ' in the string
    // In many corruptions, it's the sequence like E0 A4 a9 E0 a5 bc
    echo "Hex Sequence: " . bin2hex($val) . "\n";
    
    // Manually isolate the mangled character's bytes
    // Valid 'na' is E0A4A8. Dot is E0A5BC.
    // 'ऩ' is E0A4A9. 
} else {
    echo "No records found matching $mangledChar\n";
}

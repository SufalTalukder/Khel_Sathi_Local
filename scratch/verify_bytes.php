<?php
require __DIR__ . '/../application/vendor/autoload.php';
$app = require_once __DIR__ . '/../application/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$r = DB::table('information_prashikshan')->where('id', 34)->first();
if ($r) {
    $val = $r->instructor_name;
    echo "ID: 34\n";
    echo "Value: " . $val . "\n";
    echo "HEX: " . bin2hex($val) . "\n";
    
    // Test the repair function
    $repaired = repairHindi($val);
    echo "Repaired: " . $repaired . "\n";
    echo "HEX Repaired: " . bin2hex($repaired) . "\n";
    
    if ($repaired === $val) {
        echo "WARNING: Repair function did not change the string!\n";
    } else {
        echo "SUCCESS: Repair function modified the string.\n";
    }
}

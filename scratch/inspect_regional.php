<?php
require __DIR__ . '/../application/vendor/autoload.php';
$app = require_once __DIR__ . '/../application/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Fetch entries from information_kshetreey_kreeda_adhikaari
// Filter for suspected mangled data like 'क.ीौ' or 'जी'
$records = DB::table('information_kshetreey_kreeda_adhikaari')
    ->orderBy('id', 'desc')
    ->take(50)
    ->get();

$offices = DB::table('information_kshetreey_kreeda_adhikaari')->distinct()->pluck('inspected_office');
echo "--- Unique Offices ---\n";
// Fetch 2024 records for Oct/Nov
$records = DB::table('information_kshetreey_kreeda_adhikaari')
    ->where('year', '2024')
    ->whereIn('month_name', ['10', '11'])
    ->get();

foreach ($records as $r) {
    echo "--- ID: $r->id, Month: $r->month_name ---\n";
    echo "Name RAW: [$r->inspected_officer] Hex: " . bin2hex($r->inspected_officer) . "\n";
    echo "Place RAW: [$r->posting_place_division] Hex: " . bin2hex($r->posting_place_division) . "\n";
    echo "Office RAW: [$r->inspected_office] Hex: " . bin2hex($r->inspected_office) . "\n";
}

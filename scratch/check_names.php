<?php
require __DIR__ . '/../application/vendor/autoload.php';
$app = require_once __DIR__ . '/../application/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

function showName($type, $name) {
    echo "$type RAW: " . $name . "\n";
    echo "$type REPAIRED: " . repairHindi($name) . "\n\n";
}

echo "Checking District Names:\n";
$districts = DB::table('cities')->take(5)->get();
foreach ($districts as $d) {
    showName("District ($d->id)", $d->city);
}

echo "Checking Tehsil Names:\n";
$tehsils = DB::table('tehsil_master')->take(5)->get();
foreach ($tehsils as $t) {
    showName("Tehsil ($t->id)", $t->Tehsil_Name);
}

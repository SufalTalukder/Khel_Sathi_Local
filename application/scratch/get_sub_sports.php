<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;

$sportIds = [3, 6, 42]; // Cricket, Hockey, Athletics
foreach ($sportIds as $sportId) {
    echo "Sport ID $sportId sub-sports:" . PHP_EOL;
    $subs = DB::table('hostel_sub_sport_master')->where('sport_id', $sportId)->get(['id', 'sub_type']);
    foreach($subs as $s) {
        echo "  " . $s->id . ": " . $s->sub_type . PHP_EOL;
    }
}

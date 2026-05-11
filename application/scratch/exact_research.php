<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$rows = DB::table('information_honorable')
    ->where('district_id', 517)
    ->orderBy('id', 'DESC')
    ->take(15)
    ->get();

foreach ($rows as $i => $row) {
    echo "Report Row " . ($i+1) . " (ID: $row->id):\n";
    echo "  Subject: $row->subject_of_letter\n";
    echo "  Reason : $row->honble_mp_action_taken\n";
    echo "---------------------------------\n";
}

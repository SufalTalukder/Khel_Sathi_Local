<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

function toHex($str) {
    $hex = '';
    for ($i = 0; $i < mb_strlen($str); $i++) {
        $char = mb_substr($str, $i, 1);
        $hex .= sprintf("U+%04X ", mb_ord($char));
    }
    return trim($hex);
}

$rows = DB::table('information_honorable')
    ->where('district_id', 517)
    ->orderBy('id', 'DESC')
    ->limit(5)
    ->get();

foreach ($rows as $row) {
    echo "ID: {$row->id}\n";
    echo "Subject: {$row->subject_of_letter} (" . toHex($row->subject_of_letter) . ")\n";
    echo "Reason: {$row->honble_mp_action_taken} (" . toHex($row->honble_mp_action_taken) . ")\n";
    echo "---------------------------------\n";
}

echo "\nAdhikarion Prashikshon Sample:\n";
$row2 = DB::table('information_adhikaariyon_prashikshon')->limit(1)->first();
if ($row2) {
    echo "Name: {$row2->instructor_name} (" . toHex($row2->instructor_name) . ")\n";
}

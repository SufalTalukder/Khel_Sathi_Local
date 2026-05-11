<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;

$sportIds = [3, 6, 42, 43]; // Cricket, Hockey, Athletics, Badminton

foreach ($sportIds as $sportId) {
    $count = DB::table('hostel_register as hr')
        ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
        ->where('basic.sports', $sportId)
        ->where('hr.competition_level_approved', 1)
        ->where('hr.session_year', '2026')
        ->count();
    
    $genders = DB::table('hostel_register as hr')
        ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
        ->where('basic.sports', $sportId)
        ->where('hr.competition_level_approved', 1)
        ->where('hr.session_year', '2026')
        ->select('hr.gender', DB::raw('count(*) as total'))
        ->groupBy('hr.gender')
        ->get();

    echo "Sport ID $sportId: Total Approved = $count" . PHP_EOL;
    foreach($genders as $g) {
        echo "  Gender " . $g->gender . ": " . $g->total . PHP_EOL;
    }
}

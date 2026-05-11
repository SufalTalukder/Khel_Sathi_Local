<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;

$b = DB::table('hostel_register as hr')
    ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
    ->where('basic.sports', 43)
    ->get(['hr.id', 'hr.name', 'hr.competition_level_approved', 'hr.session_year']);

echo "Badminton Records for ID 43:" . PHP_EOL;
foreach($b as $row) {
    echo "ID: " . $row->id . " | Name: " . $row->name . " | Approved: " . ($row->competition_level_approved ?? 'NULL') . " | Year: " . ($row->session_year ?? 'NULL') . PHP_EOL;
}

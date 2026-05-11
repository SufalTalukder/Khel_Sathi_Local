<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;

$sports = DB::table('sport_master')->whereIn('name', ['Athletics', 'Badminton', 'Cricket', 'Hockey'])->get(['id', 'name']);
foreach($sports as $s) {
    echo $s->id . ': ' . $s->name . PHP_EOL;
}

<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\Schema;

$columns = Schema::getColumnListing('hostel_register');
foreach($columns as $c) echo $c . PHP_EOL;

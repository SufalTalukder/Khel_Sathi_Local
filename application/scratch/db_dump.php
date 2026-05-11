<?php
require dirname(__DIR__) . '/vendor/autoload.php';
$app = require_once dirname(__DIR__) . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// repairHindi is already included in bootstrap

echo "--- Modules ---\n";
$modules = DB::table('urm_module_manager')->where('module_status', 1)->get();
foreach ($modules as $m) {
    if (strpos($m->module_name, 'Monthly') !== false || strpos($m->module_name, 'Review') !== false) {
         echo "ID: {$m->id} | Name: {$m->module_name} | Repaired: " . repairHindi($m->module_name) . "\n";
    }
}

echo "\n--- Pages ---\n";
// Let's find the Module ID for Monthly Meeting Review
$moduleId = DB::table('urm_module_manager')->where('module_name', 'LIKE', '%Monthly%')->value('id');

if ($moduleId) {
    echo "Using Module ID: $moduleId\n";
    $pages = DB::table('urm_page_manager')->where('page_status', 1)->where('module_id', $moduleId)->get();
} else {
    echo "Monthly module not found, dumping all pages\n";
    $pages = DB::table('urm_page_manager')->where('page_status', 1)->get();
}

foreach ($pages as $p) {
    echo "ID: {$p->id} | Name: {$p->page_name} | Repaired: " . repairHindi($p->page_name) . "\n";
}

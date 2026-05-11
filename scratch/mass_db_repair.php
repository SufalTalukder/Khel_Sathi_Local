<?php
require __DIR__ . '/../application/vendor/autoload.php';
$app = require_once __DIR__ . '/../application/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// The definitive map of all corrupted columns found in the exhaustive audit
$repairMap = [
    "information_adhikaariyon_prashikshon" => ["instructor_name", "schools_training", "comment"],
    "information_ekalavykreedakosh" => ["comment"],
    "information_honorable" => ["name_of_honorable", "subject_of_letter", "details_of_action_taken", "honble_mp_action_taken"],
    "information_khelo_india_yojana" => ["yojna_name", "name_of_executing_agency", "material_progress", "financial_progress", "comment"],
    "information_khelo_india_yojana_two" => ["yojna_name", "name_of_executing_agency"],
    "information_kheloindiyacentar" => ["comment"],
    "information_kreeda_chatravas" => ["comment"],
    "information_kshetreey_kreeda_adhikaari" => ["inspected_officer", "subpost_name", "posting_place_division", "inspected_office"],
    "information_nodal_officer" => ["head_office_name", "officer_name", "officer_designation"],
    "information_prashikshan" => ["instructor_name", "comment"],
    "information_pratiyogitaonkaaayojan" => ["competition_name", "sponsor_name", "comment"],
    "information_project_under_construction" => ["project_name", "name_of_executing_agency", "comment"]
];

$dry_run = false; // SET TO FALSE TO ACTUALLY REPAIR

echo "=== STARTING GLOBAL SYNCHRONIZED REPAIR ===\n";

foreach ($repairMap as $table => $columns) {
    if (!Schema::hasTable($table)) continue;
    
    echo "Processing Module: $table...\n";
    $records = DB::table($table)->get();
    $repairedCount = 0;

    foreach ($records as $row) {
        $updates = [];
        foreach ($columns as $column) {
            $original = $row->$column;
            if (empty($original)) continue;
            
            $repaired = repairHindi($original);
            if ($repaired !== $original) {
                $updates[$column] = $repaired;
            }
        }

        if (!empty($updates)) {
            if (!$dry_run) {
                DB::table($table)->where('id', $row->id)->update($updates);
            }
            $repairedCount++;
        }
    }
    echo "  -> Found and Repaired: $repairedCount records.\n";
}

if ($dry_run) {
    echo "=== DRY RUN COMPLETE. NO DATA CHANGED. ===\n";
} else {
    echo "=== MASS REPAIR COMPLETE. ALL RECORDS UPDATED PERMANENTLY. ===\n";
}

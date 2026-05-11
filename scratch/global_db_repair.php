<?php
require __DIR__ . '/../application/vendor/autoload.php';
$app = require_once __DIR__ . '/../application/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

$tables = [
    'information_honorable' => ['name_of_honorable', 'subject_of_letter', 'details_of_action_taken', 'honble_mp_action_taken'],
    'information_kshetreey_kreeda_adhikaari' => ['inspected_officer', 'subpost_name', 'posting_place_division', 'inspected_office'],
    'information_official_coach' => ['officer_name', 'designation', 'place_of_posting'],
    'information_sports_competition' => ['competition_name', 'level', 'venue'],
    'information_sports_infrastructure' => ['infrastructure_name', 'location'],
    'information_sports_hostel' => ['hostel_name', 'district'],
];

$dry_run = false; // SET TO FALSE TO ACTUALLY UPDATE

foreach ($tables as $table => $target_columns) {
    if (!Schema::hasTable($table)) {
        echo "Table $table does not exist. Skipping.\n";
        continue;
    }

    $all_cols = Schema::getColumnListing($table);
    $columns = array_intersect($target_columns, $all_cols);

    if (empty($columns)) {
        echo "No target columns found in $table. Available: " . implode(', ', $all_cols) . "\n";
        continue;
    }

    echo "=== Processing Table: $table ===\n";
    $records = DB::table($table)->get();
    $updated_count = 0;

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
            } else {
                echo "[Dry Run] ID: {$row->id} -> " . json_encode($updates, JSON_UNESCAPED_UNICODE) . "\n";
            }
            $updated_count++;
        }
    }
    echo "Summary for $table: $updated_count records identified for repair.\n\n";
}

if ($dry_run) {
    echo "DRY RUN COMPLETE. No data was changed.\n";
} else {
    echo "DATABASE REPAIR COMPLETE. All identified records updated.\n";
}

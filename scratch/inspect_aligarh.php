<?php
require __DIR__ . '/../application/vendor/autoload.php';
$app = require_once __DIR__ . '/../application/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Find all Aligarh matches in cities table
$aligarhs = DB::table('cities')->where('city', 'LIKE', '%Aligarh%')->get();
foreach ($aligarhs as $a) {
    echo "Aligarh entry: ID $a->id, City: $a->city\n";
}

if ($aligarhs->isEmpty()) {
    echo "Aligarh not found\n";
    exit;
}

$district_ids = $aligarhs->pluck('id')->toArray();

// Search globally across information_honorable for exact matches
$standalone_records = DB::table('information_honorable')
    ->where('subject_of_letter', 'को')
    ->orWhere('details_of_action_taken', 'को')
    ->orWhere('honble_mp_action_taken', 'कल')
    ->get();

echo "--- Global Standalone Matches ---\n";
foreach ($standalone_records as $r) {
    $city = DB::table('cities')->where('id', $r->district_id)->value('city');
    echo "ID: $r->id, District: $city ($r->district_id), Sub: [$r->subject_of_letter], Act: [$r->details_of_action_taken], MPAct: [$r->honble_mp_action_taken]\n";
}

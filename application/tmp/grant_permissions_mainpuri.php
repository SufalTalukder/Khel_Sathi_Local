<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$user_id = 58; // DSO Mainpuri
$role_id = 9;  // SO Role ID
$module_id = 9; // Hostel/Trial related module
$page_ids = [70, 72];

echo "Granting permissions for User ID $user_id...\n";

foreach ($page_ids as $page_id) {
    $exists = DB::table('urm_role_module_mapping')
        ->where('user_id', $user_id)
        ->where('page_id', $page_id)
        ->exists();

    if (!$exists) {
        DB::table('urm_role_module_mapping')->insert([
            'role_id' => $role_id,
            'user_id' => $user_id,
            'page_id' => $page_id,
            'module_id' => $module_id,
            'accees_given_by' => 0,
            'action_view' => 1,
            'action_add' => 0,
            'action_edit' => 0,
            'action_delete' => 0,
            'dor' => now(),
            'updated_by' => 0,
        ]);
        echo "Granted access to Page ID $page_id.\n";
    } else {
        echo "Access already exists for Page ID $page_id. Skipping.\n";
    }
}

echo "Done.\n";

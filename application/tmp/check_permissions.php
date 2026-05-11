<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$user_id = 58; // DSO Mainpuri
$page_names = [
    'State Competition/Trial List',
    'State Level Competition Approved List'
];

$pages = DB::table('urm_page_manager')
    ->where('page_name', 'like', '%State Competition/Trial List%')
    ->orWhere('page_name', 'like', '%State Level Competition Approved List%')
    ->get();

echo "Pages found:\n";
foreach ($pages as $page) {
    echo "ID: {$page->id}, Name: {$page->page_name}, Module: {$page->module_id}, URL: {$page->page_url}\n";
    
    $exists = DB::table('urm_role_module_mapping')
        ->where('user_id', $user_id)
        ->where('page_id', $page->id)
        ->exists();
    
    if ($exists) {
        echo "User already has access to this page.\n";
    } else {
        echo "User DOES NOT have access to this page.\n";
    }
}

$user = DB::table('admin')->where('id', $user_id)->first();
echo "\nUser: {$user->username} (ID: {$user_id}), Role: {$user->admin_role}\n";

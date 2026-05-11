<?php
require dirname(__DIR__) . '/vendor/autoload.php';
$app = require_once dirname(__DIR__) . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$updates = [
    136 => 'निर्माणाधीन परियोजनाओं की स्थिति',
    138 => 'खेलो इंडिया प्रस्ताव',
    137 => 'राजस्व प्राप्तियां',
    139 => 'खेलो इंडिया उत्कृष्टता',
    145 => 'प्रशिक्षण',
    140 => 'खेलो इंडिया सेंटर',
    141 => 'क्रीड़ा प्रतियोगिता का आयोजन',
    142 => 'एकलव्य क्रीड़ा कोष',
    143 => 'क्रीड़ा छात्रवास',
    146 => 'जिला खेल विकास',
    144 => 'व्ययाधिक्य बचत की सूचना',
    147 => 'क्षेत्रीय क्रीड़ा अधिकारी',
    148 => 'अधिकारियों/प्रशिक्षकों की सूचना',
];

foreach ($updates as $id => $name) {
    echo "Updating ID $id to: $name\n";
    DB::table('urm_page_manager')->where('id', $id)->update(['page_name' => $name]);
}

echo "Database updates complete.\n";

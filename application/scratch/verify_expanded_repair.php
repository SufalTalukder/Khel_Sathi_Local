<?php
require_once 'c:/laragon/www/application/app/Helper/helpers.php';

function testRepair($label, $input) {
    echo "Testing: $label\n";
    echo "Input:  $input\n";
    echo "Output: " . repairHindi($input) . "\n\n";
}

// Test cases based on my best guess of common corruption patterns
testRepair("District (Mau)", "ऩाऊ"); // Expected: Mau (if shifted) - actual ऩाऊ might be something else
testRepair("Regional", "खेटीीय"); // Expected: क्षेत्रीय
testRepair("Officer", "क्"); // Expected: क्रीड़ा अधिकारी (based on helpers.php:2054)
testRepair("Sport", "क्रीडा"); // Expected: क्रीड़ा अधिकारी
testRepair("Mixed name", "ऩतीश ऩींी"); // Expected: सतीश सिंह

// Testing the 'pa' shift 'र' -> 'प'
testRepair("Pa shift", "रान"); // Expected: पास ( helpers.php:2005)

echo "Verification complete.\n";

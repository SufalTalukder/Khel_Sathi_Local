<?php
$helperPath = 'c:/laragon/www/application/app/Helper/helpers.php';
$content = file_get_contents($helperPath);
// Trim trailing whitespace and newlines but keep the PHP structure
$content = rtrim($content);

$newFunction = <<<EOD


/**
 * Repairs commonly corrupted Hindi character patterns found in the database.
 * 
 * @param string \$text
 * @return string
 */
function repairHindi(\$text)
{
    if (empty(\$text) || !is_string(\$text)) {
        return \$text;
    }

    // Common mangled sequences mapping (derived from database analysis)
    \$map = [
        'श्ीी' => 'श्री',
        'अखीीेश' => 'अखिलेश',
        'ीाजीव' => 'राजीव',
        'ऻाडव' => 'यादव',
        'रीतेश' => 'रितेश',
        'गोीखमली' => 'गोरखबली',
        'भूमेंड्ी' => 'भूपेंद्र',
    ];

    \$repaired = str_replace(array_keys(\$map), array_values(\$map), \$text);

    // Heuristic: Many names have 'ी' replacing 'र' (e.g., 'ीाजीव' for 'राजीव')
    // If 'ी' is followed by 'ा' at the start of a word or after a space, it's very likely 'रा'
    \$repaired = preg_replace('/(^|[\\s,])ीा/u', '$1रा', \$repaired);

    return \$repaired;
}
EOD;

file_put_contents($helperPath, $content . $newFunction);
echo "Successfully appended repairHindi helper.";
?>

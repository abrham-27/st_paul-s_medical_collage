<?php

$dir = __DIR__;
$landing = json_decode(file_get_contents($dir . '/landing.json'), true);

$slugs = ['emergency', 'neonatal', 'medical', 'operative'];
$departments = [];

foreach ($slugs as $slug) {
    $departments[] = json_decode(file_get_contents($dir . "/{$slug}.json"), true);
}

return [
    'landing' => $landing,
    'departments' => $departments,
];

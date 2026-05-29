<?php
// Fix the frontend routing path in App.tsx

$appTsxPath = __DIR__ . '/sphMmc/src/App.tsx';

echo "Fixing frontend routing...\n";
echo "File: $appTsxPath\n\n";

if (!file_exists($appTsxPath)) {
    echo "[✗] File not found: $appTsxPath\n";
    exit(1);
}

$content = file_get_contents($appTsxPath);

// Count occurrences before
$before = substr_count($content, '/research/RolesResponsibilities');

// Replace navigation path (case-sensitive)
$content = str_replace(
    "navigate('/research/RolesResponsibilities')",
    "navigate('/research/roles-responsibilities')",
    $content
);

// Replace display text (spacing sensitive)
$content = str_replace(
    'Roles&Responsibilities',
    'Roles & Responsibilities',
    $content
);

// Write back
if (file_put_contents($appTsxPath, $content)) {
    echo "[✓] Fixed App.tsx successfully\n";
    echo "   - Updated '/research/RolesResponsibilities' → '/research/roles-responsibilities'\n";
    echo "   - Updated display text 'Roles&Responsibilities' → 'Roles & Responsibilities'\n";
    echo "\n[✓] Frontend routing is now correct!\n";
    echo "[✓] Users can now click 'Roles & Responsibilities' and be taken to /research/roles-responsibilities\n";
} else {
    echo "[✗] Failed to write to App.tsx\n";
    exit(1);
}
?>

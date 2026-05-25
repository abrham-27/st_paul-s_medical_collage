<?php
// scripts/fix_readonly.php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Running fix_readonly.php\n";
try {
    $curr = DB::selectOne('SELECT CURRENT_USER() as user');
    echo 'CURRENT_USER: ' . ($curr->user ?? (is_array($curr) ? json_encode($curr) : 'unknown')) . PHP_EOL;

    $r = DB::selectOne("SHOW VARIABLES LIKE 'read_only'");
    $s = DB::selectOne("SHOW VARIABLES LIKE 'super_read_only'");
    echo 'read_only: ' . ($r->Value ?? $r->value ?? '') . PHP_EOL;
    echo 'super_read_only: ' . ($s->Value ?? $s->value ?? '') . PHP_EOL;

    $grants = DB::select("SHOW GRANTS FOR CURRENT_USER()");
    echo "GRANTS:\n";
    foreach ($grants as $g) {
        $arr = (array) $g;
        echo array_values($arr)[0] . PHP_EOL;
    }

    $readOn = (strtoupper($r->Value ?? $r->value ?? '') === 'ON');
    $superOn = (strtoupper($s->Value ?? $s->value ?? '') === 'ON');

    if ($readOn || $superOn) {
        echo "Attempting to disable global read-only flags...\n";
        try {
            DB::statement('SET GLOBAL super_read_only=OFF');
            echo "SET super_read_only: OK\n";
        } catch (\Exception $e) {
            echo "SET super_read_only ERR: " . $e->getMessage() . PHP_EOL;
        }
        try {
            DB::statement('SET GLOBAL read_only=OFF');
            echo "SET read_only: OK\n";
        } catch (\Exception $e) {
            echo "SET read_only ERR: " . $e->getMessage() . PHP_EOL;
        }

        $r2 = DB::selectOne("SHOW VARIABLES LIKE 'read_only'");
        $s2 = DB::selectOne("SHOW VARIABLES LIKE 'super_read_only'");
        echo 'read_only after: ' . ($r2->Value ?? $r2->value ?? '') . PHP_EOL;
        echo 'super_read_only after: ' . ($s2->Value ?? $s2->value ?? '') . PHP_EOL;
    } else {
        echo "No read-only mode detected on server variables.\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}

echo "Done.\n";

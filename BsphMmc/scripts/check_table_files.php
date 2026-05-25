<?php
// scripts/check_table_files.php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    $datadirRow = DB::selectOne("SHOW VARIABLES LIKE 'datadir'");
    $datadir = $datadirRow->Value ?? $datadirRow->value ?? null;
    $dbRow = DB::selectOne('SELECT DATABASE() as db');
    $dbname = $dbRow->db ?? $dbRow->DATABASE ?? null;
    $table = 'statistics';
    echo "datadir={$datadir}\n";
    echo "dbname={$dbname}\n";
    $paths = [];
    if ($datadir && $dbname) {
        $base = rtrim($datadir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $dbname . DIRECTORY_SEPARATOR;
        $paths[] = $base . $table . '.ibd';
        $paths[] = $base . $table . '.frm';
        $paths[] = $base . $table . '.cfg';
        $paths[] = $base . $table . '.MYD';
        $paths[] = $base . $table . '.MYI';
    }
    foreach ($paths as $p) {
        $exists = file_exists($p) ? 'yes' : 'no';
        $writable = is_writable($p) ? 'yes' : (file_exists($p) ? 'no' : 'n/a');
        $perms = file_exists($p) ? sprintf('%o', fileperms($p)) : 'n/a';
        echo "FILE: {$p}\n  exists={$exists}\n  writable={$writable}\n  perms={$perms}\n";
    }
    // Additionally list directory contents
    if (isset($base) && is_dir($base)) {
        echo "\nDirectory listing for $base (first 100 files):\n";
        $files = array_slice(scandir($base), 0, 100);
        foreach ($files as $f) {
            echo "  - $f" . PHP_EOL;
        }
    }
} catch (\Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
}

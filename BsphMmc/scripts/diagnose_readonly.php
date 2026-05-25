<?php
// scripts/diagnose_readonly.php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Running diagnose_readonly.php\n";

try {
    $table = 'statistics';
    echo "\n== SHOW VARIABLES ==\n";
    $vars = DB::select("SHOW VARIABLES WHERE Variable_name IN ('read_only','super_read_only','datadir')");
    foreach ($vars as $v) {
        $arr = (array) $v;
        echo $arr['Variable_name'] . ': ' . $arr['Value'] . PHP_EOL;
    }

    echo "\n== CURRENT_USER & GRANTS ==\n";
    $curr = DB::selectOne('SELECT CURRENT_USER() as user');
    echo 'CURRENT_USER: ' . ($curr->user ?? json_encode($curr)) . PHP_EOL;
    $grants = DB::select('SHOW GRANTS FOR CURRENT_USER()');
    foreach ($grants as $g) {
        $arr = (array) $g;
        echo array_values($arr)[0] . PHP_EOL;
    }

    echo "\n== TABLE STATUS / INFO ==\n";
    $info = DB::selectOne("SELECT TABLE_NAME, ENGINE, TABLE_ROWS, DATA_LENGTH, INDEX_LENGTH, CREATE_OPTIONS FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=?", [$table]);
    if ($info) {
        echo "TABLE_NAME: " . $info->TABLE_NAME . PHP_EOL;
        echo "ENGINE: " . $info->ENGINE . PHP_EOL;
        echo "TABLE_ROWS: " . $info->TABLE_ROWS . PHP_EOL;
        echo "DATA_LENGTH: " . $info->DATA_LENGTH . PHP_EOL;
        echo "INDEX_LENGTH: " . $info->INDEX_LENGTH . PHP_EOL;
        echo "CREATE_OPTIONS: " . $info->CREATE_OPTIONS . PHP_EOL;
    } else {
        echo "No information for table $table in information_schema\n";
    }

    echo "\n== SHOW CREATE TABLE ==\n";
    $create = DB::selectOne("SHOW CREATE TABLE `$table`");
    if ($create) {
        $arr = (array) $create;
        $key = null;
        foreach ($arr as $k => $v) { if (stripos($k, 'Create') !== false) { $key = $k; break; } }
        echo ($key ? $arr[$key] : json_encode($arr)) . PHP_EOL;
    }

    echo "\n== DATADIR & FILESYSTEM CHECKS ==\n";
    $datadirRow = DB::selectOne("SHOW VARIABLES LIKE 'datadir'");
    $datadir = $datadirRow->Value ?? $datadirRow->value ?? null;
    echo 'datadir: ' . $datadir . PHP_EOL;
    if ($datadir) {
        echo 'is_dir: ' . (is_dir($datadir) ? 'yes' : 'no') . PHP_EOL;
        echo 'is_writable: ' . (is_writable($datadir) ? 'yes' : 'no') . PHP_EOL;
        $free = @disk_free_space($datadir);
        echo 'disk_free_space: ' . ($free === false ? 'unknown' : $free) . PHP_EOL;
    }

    echo "\n== Attempt safe temp insert into $table ==\n";
    try {
        $now = date('Y-m-d H:i:s');
        $tmpTitle = 'DIAGNOSTIC_TEMP_' . uniqid();
        DB::table($table)->insert(['title' => $tmpTitle, 'value' => '0', 'description' => 'diagnostic temp', 'created_at' => $now, 'updated_at' => $now]);
        echo "TEMP INSERT OK (id unknown)\n";
        // delete the temp row
        DB::table($table)->where('title', $tmpTitle)->delete();
        echo "TEMP DELETE OK\n";
    } catch (\Exception $e) {
        echo "TEMP INSERT ERROR: " . $e->getMessage() . PHP_EOL;
    }

} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}

echo "Done.\n";

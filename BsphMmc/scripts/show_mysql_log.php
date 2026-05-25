<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;
try {
    $row = DB::selectOne("SHOW VARIABLES LIKE 'log_error'");
    $log = $row->Value ?? $row->value ?? null;
    echo "log_error: " . $log . PHP_EOL;
    if ($log && file_exists($log)) {
        echo "\n== Last 200 lines of MySQL error log ==\n";
        $lines = file($log, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $tail = array_slice($lines, -200);
        foreach ($tail as $l) echo $l . PHP_EOL;
    } else {
        echo "Error log not found or empty path.\n";
    }
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
}

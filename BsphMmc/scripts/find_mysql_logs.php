<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;

$datadirRow = DB::selectOne("SHOW VARIABLES LIKE 'datadir'");
$datadir = $datadirRow->Value ?? $datadirRow->value ?? null;
$root = dirname($datadir);
$searchPaths = [
    $datadir,
    $root . DIRECTORY_SEPARATOR . 'mysql' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR,
    $root . DIRECTORY_SEPARATOR . 'mysql' . DIRECTORY_SEPARATOR,
    $root,
    $root . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR,
];
$found = [];
foreach ($searchPaths as $p) {
    if (!is_dir($p)) continue;
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($p));
    foreach ($it as $file) {
        if ($file->isFile()) {
            $name = $file->getFilename();
            if (stripos($name, 'mysql') !== false && stripos($name, 'log') !== false) {
                $found[] = $file->getPathname();
            }
            if (preg_match('/\.(err|log|txt)$/i', $name) && (stripos($name, 'mysql')!==false || stripos($name,'error')!==false)) {
                $found[] = $file->getPathname();
            }
        }
    }
}
$found = array_unique($found);
if (empty($found)) echo "No candidate log files found under searched paths.\n";
else {
    echo "Found log candidates:\n";
    foreach ($found as $f) echo $f . PHP_EOL;
}

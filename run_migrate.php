<?php
// Simple migration runner
chdir(__DIR__ . '/BsphMmc');
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\ArrayInput(['command' => 'migrate', '--step']),
    $output = new Symfony\Component\Console\Output\BufferedOutput()
);
echo $output->fetch();
exit($status);
?>

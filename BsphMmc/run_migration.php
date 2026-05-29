<?php
/**
 * Quick Migration Runner
 * This script runs pending migrations without using artisan
 */

// Change to the Laravel app directory
chdir(__DIR__);

// Load Laravel
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

// Get the Laravel application instance
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

try {
    // Run migrations
    $exitCode = $kernel->call('migrate', [
        '--step' => true,
        '--force' => true,
    ]);
    
    echo "Migration completed successfully!\n";
    echo "Exit code: " . $exitCode . "\n";
} catch (Exception $e) {
    echo "Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}

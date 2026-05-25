<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\LatestPost;
use App\Models\Gallery;

echo 'latest_posts=' . LatestPost::count() . PHP_EOL;
echo 'announcements=' . LatestPost::where('type','announcement')->count() . PHP_EOL;
echo 'galleries=' . Gallery::count() . PHP_EOL;

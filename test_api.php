<?php
// Simple test script to verify API endpoints
require_once 'vendor/autoload.php';

use Illuminate\Http\Request;

// Test basic API response
echo "Testing API endpoints...\n";

// Test 1: Basic resource endpoint
$response = file_get_contents('http://127.0.0.1:8001/api/latest-posts');
echo "1. Basic endpoint: " . ($response ? "SUCCESS" : "FAILED") . "\n";

// Test 2: Latest news endpoint  
$response = file_get_contents('http://127.0.0.1:8001/api/latest-posts/latest-news');
echo "2. Latest news: " . ($response ? "SUCCESS" : "FAILED") . "\n";

// Test 3: Latest announcements endpoint
$response = file_get_contents('http://127.0.0.1:8001/api/latest-posts/latest-announcements');
echo "3. Latest announcements: " . ($response ? "SUCCESS" : "FAILED") . "\n";

// Test 4: Upcoming events endpoint
$response = file_get_contents('http://127.0.0.1:8001/api/latest-posts/upcoming-events');
echo "4. Upcoming events: " . ($response ? "SUCCESS" : "FAILED") . "\n";

echo "API test completed!\n";
?>

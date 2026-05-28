<?php
// Simple test script to verify API endpoints
$baseUrl = 'http://127.0.0.1:8000/api';

function testEndpoint($url, $name) {
    echo "Testing $name: $url\n";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'Content-Type: application/json'
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200) {
        $data = json_decode($response, true);
        if ($data && isset($data['success']) && $data['success']) {
            echo "✅ SUCCESS: $name\n";
            return true;
        } else {
            echo "❌ FAILED: $name - Invalid response format\n";
            echo "Response: " . substr($response, 0, 200) . "...\n";
        }
    } else {
        echo "❌ FAILED: $name - HTTP $httpCode\n";
        echo "Response: " . substr($response, 0, 200) . "...\n";
    }
    
    return false;
}

echo "=== API Endpoint Tests ===\n\n";

// Test About endpoint
testEndpoint("$baseUrl/about", "About Page");

// Test Mission Vision Values endpoint
testEndpoint("$baseUrl/mission-vision-values", "Mission Vision Values");

echo "\n=== Test Complete ===\n";
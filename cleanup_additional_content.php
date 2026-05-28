<?php
// Script to clean up additional_content field
require_once 'BsphMmc/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Database configuration
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'sphmmc_db',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

try {
    // Get the about page record
    $aboutPage = Capsule::table('about_pages')->first();
    
    if ($aboutPage && $aboutPage->additional_content) {
        echo "Current additional_content:\n";
        echo $aboutPage->additional_content . "\n\n";
        
        // Clean up the content
        $content = $aboutPage->additional_content;
        
        // Remove HTML tags and decode entities
        $content = strip_tags($content);
        $content = html_entity_decode($content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        echo "Cleaned content:\n";
        echo $content . "\n\n";
        
        // Validate JSON
        $decoded = json_decode($content, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            echo "JSON is valid!\n";
            
            // Update the database
            Capsule::table('about_pages')
                ->where('id', $aboutPage->id)
                ->update(['additional_content' => $content]);
                
            echo "Database updated successfully!\n";
        } else {
            echo "JSON is invalid: " . json_last_error_msg() . "\n";
        }
    } else {
        echo "No about page found or no additional_content\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
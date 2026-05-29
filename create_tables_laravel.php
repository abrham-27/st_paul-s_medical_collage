<?php
// Change to Laravel directory
chdir(__DIR__ . '/BsphMmc');

// Load Laravel's Autoloader
require __DIR__ . '/BsphMmc/vendor/autoload.php';

// Load the Laravel application
$app = require_once __DIR__ . '/BsphMmc/bootstrap/app.php';

// Make the app
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Get PDO from Laravel
use Illuminate\Support\Facades\DB;

$db = DB::connection();

$tables = [
    'role_responsibility_content' => "
        CREATE TABLE IF NOT EXISTS `role_responsibility_content` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `section_type` varchar(255) NOT NULL,
            `title` varchar(255),
            `subtitle` varchar(255),
            `content` longtext,
            `image_url` varchar(255),
            `cta_button_text` varchar(255),
            `cta_button_link` varchar(255),
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            KEY `section_type` (`section_type`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ",
    
    'role_responsibility_categories' => "
        CREATE TABLE IF NOT EXISTS `role_responsibility_categories` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` varchar(255) NOT NULL,
            `summary` text,
            `description` longtext,
            `icon` varchar(255),
            `image_url` varchar(255),
            `order` int unsigned DEFAULT 0,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            KEY `order` (`order`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ",
    
    'role_responsibility_processes' => "
        CREATE TABLE IF NOT EXISTS `role_responsibility_processes` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` varchar(255) NOT NULL,
            `description` text,
            `order` int unsigned DEFAULT 0,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            KEY `order` (`order`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ",
    
    'role_responsibility_policies' => "
        CREATE TABLE IF NOT EXISTS `role_responsibility_policies` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` varchar(255) NOT NULL,
            `description` text,
            `file_path` varchar(255),
            `file_name` varchar(255),
            `category` varchar(255),
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ",
    
    'role_responsibility_faqs' => "
        CREATE TABLE IF NOT EXISTS `role_responsibility_faqs` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `question` varchar(255) NOT NULL,
            `answer` longtext,
            `order` int unsigned DEFAULT 0,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            KEY `order` (`order`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ",
    
    'role_responsibility_statistics' => "
        CREATE TABLE IF NOT EXISTS `role_responsibility_statistics` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` varchar(255) NOT NULL,
            `value` varchar(255),
            `icon` varchar(255),
            `order` int unsigned DEFAULT 0,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            KEY `order` (`order`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ",
    
    'role_responsibility_contact' => "
        CREATE TABLE IF NOT EXISTS `role_responsibility_contact` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `office_name` varchar(255),
            `email` varchar(255),
            `phone` varchar(255),
            `location` varchar(255),
            `office_hours` text,
            `additional_info` longtext,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    "
];

echo "Creating database tables...\n";

foreach ($tables as $tableName => $sql) {
    try {
        $db->statement($sql);
        echo "[✓] Created table: $tableName\n";
    } catch (\Exception $e) {
        echo "[✗] Error creating $tableName: " . $e->getMessage() . "\n";
    }
}

echo "\n[✓] All database tables created successfully!\n";
?>

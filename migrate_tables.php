<?php
/**
 * Direct Database Migration Script
 * Creates all required tables for Roles and Responsibility module
 */

// Database configuration
$dbHost = '127.0.0.1';
$dbPort = 3306;
$dbDatabase = 'sphmmc_db';
$dbUsername = 'root';
$dbPassword = '';

echo "=== Roles and Responsibility Database Migration ===\n";
echo "Database: $dbDatabase\n";
echo "Host: $dbHost\n\n";

try {
    // Create PDO connection
    $pdo = new PDO(
        "mysql:host=$dbHost;port=$dbPort;charset=utf8mb4",
        $dbUsername,
        $dbPassword,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
    
    echo "[✓] Connected to MySQL\n\n";
    
    // Check if database exists, if not create it
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbDatabase`");
    echo "[✓] Database exists or created\n";
    
    // Select the database
    $pdo->exec("USE `$dbDatabase`");
    echo "[✓] Selected database: $dbDatabase\n\n";
    
    // SQL statements for all tables
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
                UNIQUE KEY `section_type` (`section_type`)
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
                `sort_order` int unsigned DEFAULT 0,
                `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                KEY `sort_order` (`sort_order`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ",
        
        'role_responsibility_processes' => "
            CREATE TABLE IF NOT EXISTS `role_responsibility_processes` (
                `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `title` varchar(255) NOT NULL,
                `description` text,
                `sort_order` int unsigned DEFAULT 0,
                `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                KEY `sort_order` (`sort_order`)
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
                `sort_order` int unsigned DEFAULT 0,
                `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                KEY `sort_order` (`sort_order`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ",
        
        'role_responsibility_statistics' => "
            CREATE TABLE IF NOT EXISTS `role_responsibility_statistics` (
                `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `title` varchar(255) NOT NULL,
                `value` varchar(255),
                `icon` varchar(255),
                `sort_order` int unsigned DEFAULT 0,
                `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                KEY `sort_order` (`sort_order`)
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
    
    // Execute table creation statements
    echo "Creating tables...\n";
    echo str_repeat("-", 50) . "\n";
    
    foreach ($tables as $tableName => $sql) {
        try {
            $pdo->exec($sql);
            echo "[✓] Created table: `$tableName`\n";
        } catch (PDOException $e) {
            echo "[✗] Error creating `$tableName`: " . $e->getMessage() . "\n";
            throw $e;
        }
    }
    
    echo str_repeat("-", 50) . "\n\n";
    
    // Verify tables were created
    $result = $pdo->query("SHOW TABLES LIKE 'role_responsibility%'")->fetchAll();
    echo "✓ SUCCESS! Created " . count($result) . " tables:\n";
    foreach ($result as $row) {
        echo "  - " . current($row) . "\n";
    }
    
    echo "\n[✓] Migration completed successfully!\n";
    echo "[✓] The admin panel can now access the database tables\n";
    echo "[✓] The frontend can now fetch data from the API\n";
    
} catch (PDOException $e) {
    echo "[✗] FAILED: " . $e->getMessage() . "\n";
    echo "Make sure MySQL is running on localhost:3306\n";
    exit(1);
}
?>

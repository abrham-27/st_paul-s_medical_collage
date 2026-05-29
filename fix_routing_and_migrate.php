<?php
// Fix the frontend routing issue and create database tables

// 1. Fix the App.tsx navigation path
$appTsxPath = 'C:\Users\tesfa\Desktop\allprojects\F_sphMmc\sphMmc\src\App.tsx';
if (file_exists($appTsxPath)) {
    $content = file_get_contents($appTsxPath);
    
    // Fix the navigation path
    $content = str_replace(
        "navigate('/research/RolesResponsibilities')",
        "navigate('/research/roles-responsibilities')",
        $content
    );
    
    // Fix the display text
    $content = str_replace(
        'Roles&Responsibilities',
        'Roles & Responsibilities',
        $content
    );
    
    file_put_contents($appTsxPath, $content);
    echo "[✓] Fixed frontend navigation path in App.tsx\n";
} else {
    echo "[✗] App.tsx not found at: $appTsxPath\n";
}

// 2. Create database tables via raw SQL
$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'sphmmc_db';

try {
    $pdo = new PDO("mysql:host=$dbHost;charset=utf8mb4", $dbUser, $dbPassword);
    
    // SQL statements to create all tables
    $sqlStatements = [
        // Create role_responsibility_content table
        "CREATE TABLE IF NOT EXISTS `{$dbName}`.`role_responsibility_content` (
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
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        // Create role_responsibility_categories table
        "CREATE TABLE IF NOT EXISTS `{$dbName}`.`role_responsibility_categories` (
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
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        // Create role_responsibility_processes table
        "CREATE TABLE IF NOT EXISTS `{$dbName}`.`role_responsibility_processes` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` varchar(255) NOT NULL,
            `description` text,
            `order` int unsigned DEFAULT 0,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            KEY `order` (`order`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        // Create role_responsibility_policies table
        "CREATE TABLE IF NOT EXISTS `{$dbName}`.`role_responsibility_policies` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` varchar(255) NOT NULL,
            `description` text,
            `file_path` varchar(255),
            `file_name` varchar(255),
            `category` varchar(255),
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        // Create role_responsibility_faqs table
        "CREATE TABLE IF NOT EXISTS `{$dbName}`.`role_responsibility_faqs` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `question` varchar(255) NOT NULL,
            `answer` longtext,
            `order` int unsigned DEFAULT 0,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            KEY `order` (`order`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        // Create role_responsibility_statistics table
        "CREATE TABLE IF NOT EXISTS `{$dbName}`.`role_responsibility_statistics` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` varchar(255) NOT NULL,
            `value` varchar(255),
            `icon` varchar(255),
            `order` int unsigned DEFAULT 0,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            KEY `order` (`order`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        
        // Create role_responsibility_contact table
        "CREATE TABLE IF NOT EXISTS `{$dbName}`.`role_responsibility_contact` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `office_name` varchar(255),
            `email` varchar(255),
            `phone` varchar(255),
            `location` varchar(255),
            `office_hours` text,
            `additional_info` longtext,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
    ];
    
    foreach ($sqlStatements as $sql) {
        $pdo->exec($sql);
    }
    
    echo "[✓] Successfully created all database tables\n";
    echo "[✓] Tables created: role_responsibility_content, categories, processes, policies, faqs, statistics, contact\n";
    
} catch (PDOException $e) {
    echo "[✗] Database error: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n[✓] All fixes completed successfully!\n";
echo "The frontend will now redirect to /research/roles-responsibilities\n";
echo "All database tables have been created\n";
?>

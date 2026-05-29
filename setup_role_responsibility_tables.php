<?php
/**
 * Role Responsibility Module Database Setup
 * This script creates all required database tables
 * 
 * Access via: http://localhost:8000/setup-tables
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Role Responsibility Module Setup</h1>";
echo "<hr>";

try {
    // Get database connection from .env
    $env = parse_ini_file(__DIR__ . '/BsphMmc/.env');
    
    $host = $env['DB_HOST'] ?? '127.0.0.1';
    $db = $env['DB_DATABASE'] ?? 'sphmmc_db';
    $user = $env['DB_USERNAME'] ?? 'root';
    $pass = $env['DB_PASSWORD'] ?? '';
    $charset = 'utf8mb4';
    
    $dsn = "mysql:host=$host;charset=$charset";
    $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    
    // Connect to MySQL
    $pdo = new \PDO($dsn, $user, $pass, $options);
    $pdo->exec("USE `$db`");
    
    echo "<p><strong>✓ Connected to database:</strong> $db</p>";
    echo "<hr>";
    
    // SQL statements to create tables
    $tables = [
        'role_responsibility_content' => "
            CREATE TABLE IF NOT EXISTS `role_responsibility_content` (
              `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `section_type` varchar(255) NOT NULL,
              `title` varchar(255) NULL,
              `subtitle` text NULL,
              `content` longtext NULL,
              `image` varchar(255) NULL,
              `cta_button_text` varchar(255) NULL,
              `cta_button_link` varchar(255) NULL,
              `status` tinyint(1) NOT NULL DEFAULT 1,
              `created_at` timestamp NULL,
              `updated_at` timestamp NULL,
              UNIQUE KEY `role_responsibility_content_section_type_unique` (`section_type`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ",
        'role_responsibility_categories' => "
            CREATE TABLE IF NOT EXISTS `role_responsibility_categories` (
              `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `title` varchar(255) NOT NULL,
              `icon` varchar(255) NULL,
              `image` varchar(255) NULL,
              `summary` text NOT NULL,
              `detailed_content` longtext NOT NULL,
              `sort_order` int NOT NULL DEFAULT 0,
              `status` tinyint(1) NOT NULL DEFAULT 1,
              `created_at` timestamp NULL,
              `updated_at` timestamp NULL,
              KEY `role_responsibility_categories_status_index` (`status`),
              KEY `role_responsibility_categories_sort_order_index` (`sort_order`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ",
        'role_responsibility_processes' => "
            CREATE TABLE IF NOT EXISTS `role_responsibility_processes` (
              `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `title` varchar(255) NOT NULL,
              `description` longtext NOT NULL,
              `step_number` int NOT NULL,
              `icon` varchar(255) NULL,
              `sort_order` int NOT NULL DEFAULT 0,
              `status` tinyint(1) NOT NULL DEFAULT 1,
              `created_at` timestamp NULL,
              `updated_at` timestamp NULL,
              KEY `role_responsibility_processes_status_index` (`status`),
              KEY `role_responsibility_processes_step_number_index` (`step_number`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ",
        'role_responsibility_policies' => "
            CREATE TABLE IF NOT EXISTS `role_responsibility_policies` (
              `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `title` varchar(255) NOT NULL,
              `description` text NULL,
              `file_path` varchar(255) NOT NULL,
              `file_type` varchar(255) NOT NULL,
              `file_size` varchar(255) NULL,
              `category` varchar(255) NULL,
              `sort_order` int NOT NULL DEFAULT 0,
              `status` tinyint(1) NOT NULL DEFAULT 1,
              `created_at` timestamp NULL,
              `updated_at` timestamp NULL,
              KEY `role_responsibility_policies_status_index` (`status`),
              KEY `role_responsibility_policies_category_index` (`category`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ",
        'role_responsibility_faqs' => "
            CREATE TABLE IF NOT EXISTS `role_responsibility_faqs` (
              `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `question` varchar(255) NOT NULL,
              `answer` longtext NOT NULL,
              `sort_order` int NOT NULL DEFAULT 0,
              `status` tinyint(1) NOT NULL DEFAULT 1,
              `created_at` timestamp NULL,
              `updated_at` timestamp NULL,
              KEY `role_responsibility_faqs_status_index` (`status`),
              KEY `role_responsibility_faqs_sort_order_index` (`sort_order`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ",
        'role_responsibility_statistics' => "
            CREATE TABLE IF NOT EXISTS `role_responsibility_statistics` (
              `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `label` varchar(255) NOT NULL,
              `value` varchar(255) NOT NULL,
              `icon` varchar(255) NULL,
              `description` text NULL,
              `sort_order` int NOT NULL DEFAULT 0,
              `status` tinyint(1) NOT NULL DEFAULT 1,
              `created_at` timestamp NULL,
              `updated_at` timestamp NULL,
              KEY `role_responsibility_statistics_status_index` (`status`),
              KEY `role_responsibility_statistics_sort_order_index` (`sort_order`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ",
        'role_responsibility_contact' => "
            CREATE TABLE IF NOT EXISTS `role_responsibility_contact` (
              `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `office_name` varchar(255) NOT NULL,
              `office_location` varchar(255) NULL,
              `email` varchar(255) NULL,
              `phone` varchar(255) NULL,
              `office_hours` text NULL,
              `website` varchar(255) NULL,
              `additional_info` longtext NULL,
              `status` tinyint(1) NOT NULL DEFAULT 1,
              `created_at` timestamp NULL,
              `updated_at` timestamp NULL,
              UNIQUE KEY `role_responsibility_contact_office_name_unique` (`office_name`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        "
    ];
    
    echo "<h3>Creating Tables:</h3>";
    echo "<ul>";
    
    foreach ($tables as $tableName => $sql) {
        try {
            $pdo->exec($sql);
            echo "<li><strong>✓</strong> $tableName</li>";
        } catch (\PDOException $e) {
            if (strpos($e->getMessage(), 'already exists') !== false || strpos($e->getMessage(), '1050') !== false) {
                echo "<li><strong>⊙</strong> $tableName (already exists)</li>";
            } else {
                throw $e;
            }
        }
    }
    
    echo "</ul>";
    echo "<hr>";
    echo "<p style='color: green; font-weight: bold;'>✓ Setup completed successfully!</p>";
    echo "<p><a href='/admin'>Go to Admin Panel</a></p>";
    
} catch (\Exception $e) {
    echo "<p style='color: red;'><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    exit(1);
}
?>


-- Role Responsibility Tables Creation Script
-- Copy and paste this entire content into MySQL Workbench or phpMyAdmin
-- OR save as .sql file and import it

USE `sphmmc_db`;

-- Hero Section Content
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Responsibility Categories
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Workflow/Process Steps
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Policy/Document Management
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- FAQ
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Statistics/Highlights
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contact Information
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Completion message
-- All 7 tables have been created successfully!
-- You can now access the admin panel and start adding content.

-- Database creation script for PHP Assignment
-- Database Name: php_assignment

CREATE DATABASE IF NOT EXISTS `php_assignment` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `php_assignment`;

-- --------------------------------------------------------

-- Table structure for table `students`

CREATE TABLE IF NOT EXISTS `students` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `gender` VARCHAR(20),
    `standard` VARCHAR(50) NOT NULL,
    `date_of_birth` DATE NOT NULL,
    `age` INT NOT NULL,
    `father_name` VARCHAR(100),
    `father_mobile` VARCHAR(10) NOT NULL,
    `email` VARCHAR(150) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


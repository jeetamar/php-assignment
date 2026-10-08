<?php
/**
 * Database Connection Configuration
 * Uses PDO with Prepared Statements
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'php_assignment');
define('DB_USER', 'root');
define('DB_PASS', '');

/**
 * Get Database Connection
 * 
 * @return PDO|null Returns PDO connection instance or null on failure
 */
function getDbConnection(): ?PDO {
    static $pdo = null;

    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Log error internally in production; return null to caller for graceful handling
            error_log("Database Connection Error: " . $e->getMessage());
            return null;
        }
    }

    return $pdo;
}


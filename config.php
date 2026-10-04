<?php
/**
 * Database Configuration
 * Supports environment variables for cloud deployment (Vercel, Railway, etc.)
 * with fallback to local XAMPP defaults.
 */

$host     = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
$database = getenv('DB_NAME') ?: 'park';
$port     = getenv('DB_PORT') ? (int)getenv('DB_PORT') : 3306;

// Establish database connection
$con = mysqli_init();

if (!$con) {
    die("mysqli_init failed");
}

// Support SSL if provided in environment (useful for TiDB, Aiven, Supabase)
if (getenv('MYSQL_ATTR_SSL_CA')) {
    mysqli_ssl_set($con, NULL, NULL, getenv('MYSQL_ATTR_SSL_CA'), NULL, NULL);
}

$connected = @mysqli_real_connect($con, $host, $username, $password, $database, $port);

if (!$connected) {
    // When deploying without DB setup, provide informative message
    $db_error = mysqli_connect_error();
} else {
    mysqli_set_charset($con, "utf8mb4");
}
?>
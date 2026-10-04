<?php
/**
 * Database Configuration
 * Local XAMPP + TiDB Cloud
 */

$host     = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
$database = getenv('DB_NAME') ?: 'park';
$port     = getenv('DB_PORT') ? (int)getenv('DB_PORT') : 3306;

// Initialize MySQL connection
$con = mysqli_init();

if (!$con) {
    die("mysqli_init failed");
}

// TiDB Cloud SSL certificate
$ssl_ca = getenv('MYSQL_ATTR_SSL_CA');

if (!$ssl_ca) {
    $local_ca = __DIR__ . '/isrgrootx1.pem';

    if (file_exists($local_ca)) {
        $ssl_ca = $local_ca;
    }
}

// Enable SSL when connecting to TiDB
if ($ssl_ca) {
    mysqli_ssl_set(
        $con,
        NULL,
        NULL,
        $ssl_ca,
        NULL,
        NULL
    );
}

// Connect to database
$connected = @mysqli_real_connect(
    $con,
    $host,
    $username,
    $password,
    $database,
    $port
);

if (!$connected) {
    $db_error = mysqli_connect_error();

    die("Database connection failed: " . $db_error);
}

// Set UTF-8
mysqli_set_charset($con, "utf8mb4");
?>
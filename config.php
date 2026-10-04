<?php
/**
 * Database Configuration
 * Local XAMPP + TiDB Cloud
 */

$host = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
$database = getenv('DB_NAME') ?: 'park';
$port = getenv('DB_PORT') ? (int)getenv('DB_PORT') : 3306;

$con = mysqli_init();

if (!$con) {
    die("mysqli_init failed");
}

/*
 * TiDB Cloud Starter requires TLS.
 *
 * On Vercel/Linux, use the system CA bundle.
 * TiDB Cloud uses Let's Encrypt certificates.
 */
if ($host !== 'localhost') {

    $ca_paths = [
        getenv('MYSQL_ATTR_SSL_CA'),
        '/etc/ssl/certs/ca-certificates.crt',
        '/etc/ssl/cert.pem',
        __DIR__ . '/isrgrootx1.pem'
    ];

    $ca_file = null;

    foreach ($ca_paths as $path) {
        if ($path && file_exists($path)) {
            $ca_file = $path;
            break;
        }
    }

    if (!$ca_file) {
        die("SSL CA certificate not found.");
    }

    mysqli_ssl_set(
        $con,
        null,
        null,
        $ca_file,
        null,
        null
    );
}

$connected = @mysqli_real_connect(
    $con,
    $host,
    $username,
    $password,
    $database,
    $port
);

if (!$connected) {
    die("Database connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($con, "utf8mb4");
?>
<?php
// Database configuration (match your docker-compose.yml)
$host = 'db';          // The service name in docker-compose (not 'localhost')
$db   = 'mydb';        // Database name
$user = 'user';        // MySQL username
$pass = 'userpass';    // MySQL password
$charset = 'utf8mb4';

// DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO options for better error handling and performance
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch results as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use real prepared statements
];

try {
    // Create a PDO instance (connect to the database)
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "✅ Database connection successful!";
} catch (PDOException $e) {
    // Handle connection errors
    echo "❌ Database connection failed: " . $e->getMessage();
}

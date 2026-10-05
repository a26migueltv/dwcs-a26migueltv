<?php
require_once("MyGuests.php");
class Operations
{
    private $conn;
    public function __construct()
    {
        $this->openConnection();
    }
    public function openConnection()
    {

        // Database configuration (match your docker-compose.yml)
        $host = 'mysql';          // The service name in docker-compose (not 'localhost')
        $db   = 'app';        // Database name
        $user = 'app';        // MySQL username
        $pass = 'app_password';    // MySQL password
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
            $this->conn = new PDO($dsn, $user, $pass, $options);
            echo "✅ Database connection successful!";
        } catch (PDOException $e) {
            // Handle connection errors
            echo "❌ Database connection failed: " . $e->getMessage();
        }
    }
    public function closeConnection()
    {
        $this->conn = null;
    }
}

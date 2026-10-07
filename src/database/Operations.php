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


        $this->conn = new PDO($dsn, $user, $pass, $options);
    }
    public function closeConnection()
    {
        $this->conn = null;
    }
    public function getMyGuest($id)
    {
        $sqlString = "select id, firstname, lastanem, email, reg_date from myguests where id = ?;";
        $query = $this->conn->prepare($sqlString);
        $query->execute([$id]); // It executes the sql sentence
        $rowMyGuest = $query->fetch(); //It accesses the first row of data
        //Create an object of MyGuest with the contents of the table row
        $obx = new MyGuests();
        $obx->setFirstname($rowMyGuest["firstname"]);
        $obx->setId($rowMyGuest["id"]);
        $obx->setLastname($rowMyGuest["lastname"]);
        $obx->setEmail($rowMyGuest["email"]);
        //$obx->setReg_date($rowMyGuest["reg_date"]);
        return $obx;
    }
}

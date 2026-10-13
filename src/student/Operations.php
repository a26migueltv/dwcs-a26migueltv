<?php
require_once("Student.php");
class Operations
{
    private $conn;
    public function __construct()
    {
        $this->openConnection();
    }
    // Private (-) as in the class diagram: only the constructor calls it
    private function openConnection()
    {
        // Database configuration (match your docker-compose.yml)
        $host = 'mysql';          // The service name in docker-compose (not 'localhost')
        $db   = 'app';            // Database name
        $user = 'app';            // MySQL username
        $pass = 'app_password';   // MySQL password
        $charset = 'utf8mb4';

        // DSN (Data Source Name)
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        // PDO options for better error handling and performance
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch results as associative arrays
            PDO::ATTR_EMULATE_PREPARES   => false,                  // Use real prepared statements
        ];

        // Create a PDO instance (connect to the database)
        $this->conn = new PDO($dsn, $user, $pass, $options);
    }
    public function closeConnection()
    {
        $this->conn = null;
    }
    public function getStudent($id)
    {
        $sqlString = "select id, dni, name, surname, age from student where id = ?;";
        $query = $this->conn->prepare($sqlString);
        $query->execute([$id]); // It executes the sql sentence
        $rowStudent = $query->fetch(); // It accesses the first row of data
        // If there is no row with that id, fetch() returns false
        if ($rowStudent === false) {
            throw new Exception("getStudent(): there is no student with id $id");
        }
        //Create an object of Student with the contents of the table row
        $obx = new Student();
        $obx->setId($rowStudent["id"]);
        $obx->setDni($rowStudent["dni"]);
        $obx->setName($rowStudent["name"]);
        $obx->setSurname($rowStudent["surname"]);
        $obx->setAge($rowStudent["age"]);
        return $obx;
    }
    public function getAllStudents()
    {
        $sqlString = "select id, dni, name, surname, age from student;";
        $query = $this->conn->prepare($sqlString);
        $query->execute(); // It executes the sql sentence
        $studentList = array(); //Create an empty list
        while ($rowStudent = $query->fetch()) {
            //Create an object of Student with the contents of the table row
            $obx = new Student();
            $obx->setId($rowStudent["id"]);
            $obx->setDni($rowStudent["dni"]);
            $obx->setName($rowStudent["name"]);
            $obx->setSurname($rowStudent["surname"]);
            $obx->setAge($rowStudent["age"]);
            $studentList[] = $obx;
        }
        return $studentList;
    }
    public function addStudent(Student $student)
    { //It receives an object of the class Student
        try {
            $this->conn->beginTransaction();
            $sqlString = "insert into student(dni, name, surname, age) values (?, ?, ?, ?);";
            $query = $this->conn->prepare($sqlString);
            $query->execute([$student->getDni(), $student->getName(), $student->getSurname(), $student->getAge()]); // It executes the sql sentence
            $numberOfAddedRows = $query->rowCount();
            $this->conn->commit();
            return $numberOfAddedRows;
        } catch (PDOException $erro) {
            // roll back the transaction if something failed
            $this->conn->rollback();
            throw $erro;
        }
    } //add
    function updateStudent(Student $student)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("update student set dni=?, name=?, surname=?, age=? where id=?");
            $dni = $student->getDni();
            $name = $student->getName();
            $surname = $student->getSurname();
            $age = $student->getAge();
            $id = $student->getId();
            $stmt->execute([$dni, $name, $surname, $age, $id]);
            $numberOfUpdatedRows = $stmt->rowCount();
            $this->conn->commit();
            return $numberOfUpdatedRows;
        } catch (PDOException $e) {
            // roll back the transaction if something failed
            $this->conn->rollback();
            throw $e;
        }
    } //update
    function deleteStudent($id)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("delete from student where id=?");
            $stmt->execute([$id]);
            $numberOfDeletedRows = $stmt->rowCount();
            $this->conn->commit();
            return $numberOfDeletedRows;
        } catch (PDOException $e) {
            // roll back the transaction if something failed
            $this->conn->rollback();
            throw $e;
        }
    } //delete
} //class
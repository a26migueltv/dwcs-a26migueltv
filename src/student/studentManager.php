<?php
require_once("Operations.php");

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px 15px;
        }

        .edit {
            color: white;
            background: green;
            padding: 4px 8px;
            text-decoration: none;
        }

        .delete {
            color: white;
            background: red;
            padding: 4px 8px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php
    $oper = null;
    try {
        // Open the database connection
        $oper = new Operations();

        // What we want to show (list, add, edit or delete)
        $action = "list";
        if (isset($_GET["action"])) $action = $_GET["action"];


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $op = $_POST["op"];

            if ($op == "delete") {
                $numberOfRows = $oper->deleteStudent($_POST["id"]);
                if ($numberOfRows == 1) echo "<p>Student deleted from the database</p>";
                else echo "<p>No student has been deleted</p>";
            } else {
                // add or update
                $name = test_input($_POST["name"]);
                $surname = test_input($_POST["surname"]);
                $dni = test_input($_POST["dni"]);
                $age = test_input($_POST["age"]);

                if (empty($name) || empty($surname) || empty($dni) || $age == "") {
                    throw new Exception("All the fields are required");
                }
                if (!is_numeric($age)) {
                    throw new Exception("The age must be a number");
                }

                $student = new Student();
                $student->setName($name);
                $student->setSurname($surname);
                $student->setDni($dni);
                $student->setAge($age);

                if ($op == "add") {
                    $numberOfRows = $oper->addStudent($student);
                    if ($numberOfRows == 1) echo "<p>New student added to the database</p>";
                    else echo "<p>No student has been added</p>";
                } else {
                    $student->setId($_POST["id"]);
                    $numberOfRows = $oper->updateStudent($student);
                    if ($numberOfRows == 1) echo "<p>Student modified in the database</p>";
                    else echo "<p>No student has been updated</p>";
                }
            }
            $action = "list";
        }

        // ---------- Form to add or modify ----------
        if ($action == "add" || $action == "edit") {
            if ($action == "edit") {
                $student = $oper->getStudent($_GET["id"]);
                $op = "update";
            } else {
                $student = new Student(); // empty student
                $op = "add";
            }
    ?>
            <h1>Student</h1>
            <form method="post" action="studentManager.php">
                <input type="hidden" name="op" value="<?php echo $op; ?>">
                <input type="hidden" name="id" value="<?php echo $student->getId(); ?>">
                Name:<br><input type="text" name="name" value="<?php echo $student->getName(); ?>"><br><br>
                Surname:<br><input type="text" name="surname" value="<?php echo $student->getSurname(); ?>"><br><br>
                DNI:<br><input type="text" name="dni" value="<?php echo $student->getDni(); ?>"><br><br>
                Age:<br><input type="text" name="age" value="<?php echo $student->getAge(); ?>"><br><br>
                <?php
                if ($op == "add") echo "Create new student:";
                else echo "Confirm changes:";
                ?>
                <input type="submit" value="Submit">
            </form>
            <br><a href="studentManager.php">Back</a>
        <?php
        }

        // ---------- Confirm delete ----------
        else if ($action == "delete") {
            $student = $oper->getStudent($_GET["id"]);
        ?>
            <p>You are about to delete this profile: <b><?php echo $student->getName() . " " . $student->getSurname(); ?></b></p>
            <p>Are you sure?</p>
            <form method="post" action="studentManager.php">
                <input type="hidden" name="op" value="delete">
                <input type="hidden" name="id" value="<?php echo $student->getId(); ?>">
                <input type="submit" value="Yes">
            </form>
            <br><a href="studentManager.php">Back</a>
    <?php
        }

        // ---------- List of students ----------
        else {
            echo "<h1>List of Students</h1>";
            echo "<table>";
            echo "<tr><th>Name</th><th>Surname</th><th>DNI</th><th>Age</th><th colspan='2'>Actions</th></tr>";
            $studentList = $oper->getAllStudents();
            foreach ($studentList as $s) {
                echo "<tr>";
                echo "<td>" . $s->getName() . "</td>";
                echo "<td>" . $s->getSurname() . "</td>";
                echo "<td>" . $s->getDni() . "</td>";
                echo "<td>" . $s->getAge() . "</td>";
                echo "<td><a class='edit' href='studentManager.php?action=edit&id=" . $s->getId() . "'>Modify</a></td>";
                echo "<td><a class='delete' href='studentManager.php?action=delete&id=" . $s->getId() . "'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<br><a href='studentManager.php?action=add'>Add a new student</a>";
        }
    } catch (PDOException $e) {
        echo "<p style='color:red;'>DB Error in " . $e->getFile() . " (line " . $e->getLine() . "): " . $e->getMessage() . "</p>";
        echo "<a href='studentManager.php'>Back</a>";
    } catch (Exception $e) {
        echo "<p style='color:red;'>Error in " . $e->getFile() . " (line " . $e->getLine() . "): " . $e->getMessage() . "</p>";
        echo "<a href='studentManager.php'>Back</a>";
    } finally {
        //Close connection
        if ($oper != null) $oper->closeConnection();
    }
    ?>
</body>

</html>
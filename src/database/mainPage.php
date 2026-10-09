<?php
require_once("Operations.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyGuests Management</title>
</head>

<body>
    <h1>MyGuests Management</h1>
    <?php
    try {
        // Open the database connection
        $oper = new Operations();

        // Get a row from MyGuest table
        $resultado = $oper->getMyGuest(1);
        echo $resultado;

        //Add 
        echo "<h2>Add a guest:</h2>";
        $guest1 = new MyGuests();
        $guest1->setFirstName("Ana");
        $guest1->setLastName("Ferradás");
        $guest1->setEmail("ana@ferradas.es");
        $guest1->setReg_date("2000-11-24");
        //$numberOfRows = $oper->addMyGuests($guest1);
        //if ($numberOfRows == 1) echo "<br>New guest added to the database";
        //else echo "<br>No guest has been added";

        //Update 
        echo "<h2>Update a guest:</h2>";
        $guest2 = new MyGuests();
        $guest2->setId(3);
        $guest2->setFirstName("Luis");
        $guest2->setLastName("Paz");
        $guest2->setEmail("luis@paz.es");
        $guest2->setReg_date("2002-11-24");
        $numberOfRows = $oper->updateMyGuests($guest2);
        if ($numberOfRows == 1) echo "<br>Guest modified to the database";
        else echo "<br>No guest has been updated";

        //Delete
        $numberOfRows = $oper->deleteMyGuests(3);
        if ($numberOfRows == 1) echo "<br>Guest deleted from the database";
        else echo "<br>No guest has been deleted";

        // Get all rows from MyGuest table
        echo "<h2>List of MyGuest </h2>";
        $guestList = $oper->getAllMyGuest();
        foreach ($guestList as $guest) {
            echo "<br>Guest: $guest";
        }
    } catch (PDOException $e) {
        echo "<br><p style='color:red;'>DB Error: " . $e->getMessage() . "</p><br>";
    } catch (Exception $e) {
        echo "<br><p style='color:red;'>Error: " . $e->getMessage() . "</p><br>";
    } finally {
        //Close connection
        $oper->closeConnection();
    }
    ?>
</body>

</html>
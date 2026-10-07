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
        $oper = new Operations();
        $resktado = $oper->getMyGuest(1);
        echo $resultado;
    } catch (PDOException $e) {
        // Handle connection errors
        echo "❌ Database connection failed: " . $e->getMessage();
    }

    ?>
</body>

</html>
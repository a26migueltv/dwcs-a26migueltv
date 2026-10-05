<?php
require "datos.php";


$name = $subject = $modality = "";
$errores = [];
$recibido = ($_SERVER["REQUEST_METHOD"] == "POST");
$vieneDeManage2 = false;

if ($recibido) {

    $name = test_input($_POST["name"] ?? "");
    if ($name === "") {
        $errores[] = "Name is required";
    } elseif (!preg_match("/^[\p{L} ]+$/u", $name)) {
        $errores[] = "Only letters and white space allowed in the name";
    }

    $subject = test_input($_POST["subject"] ?? "");
    if ($subject === "") {
        $errores[] = "Subject is required";
    } elseif (!isset($asignaturas[$subject])) {
        $errores[] = "That subject does not exist";
    }

    $vieneDeManage2 = isset($_POST["origen"]);
    if ($vieneDeManage2) {
        $modality = test_input($_POST["modality"] ?? "");
        if ($modality === "") {
            $errores[] = "Class type is required";
        } elseif (!isset($modalidades[$modality])) {
            $errores[] = "That class type does not exist";
        }
    }

   
    if (empty($errores)) {
        setcookie("name", $name, time() + (86400 * 30), "/");
        setcookie("subject", $subject, time() + (86400 * 30), "/");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolment</title>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>
<?php
if ($recibido) {
    if (empty($errores)) {
        if (!$vieneDeManage2) {
            
            echo "<p>$name wants to enrol in the following subject: {$asignaturas[$subject]}</p>";
            echo '<a href="manage2.php">Third Page</a>';
        } else {
           
            echo "<p>$name wants to enrol in the following subject: {$asignaturas[$subject]} and {$modalidades[$modality]} classes.</p>";
        }
    } else {
        foreach ($errores as $error) {
            echo "<p class=\"error\">$error</p>";
        }
        
        if ($vieneDeManage2) {
            echo '<a href="manage2.php">Go back to the form</a>';
        } else {
            echo '<a href="formulario.php">Go back to the form</a>';
        }
    }
} else {
    echo "<p class=\"error\">No data received.</p>";
    echo '<a href="formulario.php">Go to the form</a>';
}
?>
</body>
</html>

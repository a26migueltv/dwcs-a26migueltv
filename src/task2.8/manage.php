<?php require "datos.php"; ?>
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
$name = $subject = $modality = "";
$errores = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   
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
        if (!$vieneDeManage2) {
            // Paso 2
            echo "<p>$name wants to enrol in the following subject: {$asignaturas[$subject]}</p>";
            $url = "manage2.php?name=" . urlencode($name) . "&subject=" . urlencode($subject);
            echo '<a href="' . htmlspecialchars($url) . '">Choose class type</a>';
        } else {
            // Paso 4
            echo "<p>$name wants to enrol in the following subject: {$asignaturas[$subject]} and {$modalidades[$modality]} classes.</p>";
        }
    } else {
        foreach ($errores as $error) {
            echo "<p class=\"error\">$error</p>";
        }
        echo '<a href="formulario.php">Go back to the form</a>';
    }

} else {
    echo "<p class=\"error\">No data received.</p>";
    echo '<a href="formulario.php">Go to the form</a>';
}
?>
</body>
</html>
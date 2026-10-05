<?php
require "datos.php";

// Datos que llegan por el enlace de manage.php
// Se limpian otra vez porque cualquiera puede escribir la URL a mano
$name = test_input($_GET["name"] ?? "");
$subject = test_input($_GET["subject"] ?? "");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First practice using forms</title>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>
    <h1>First practice using forms.</h1>
    <p><span class="error">* required field</span></p>

    <form action="manage.php" method="post">
      
        <input type="hidden" name="origen" value="manage2">

        <label for="idName">Name and surnames: </label>
        <input type="text" id="idName" name="name" value="<?php echo $name; ?>" required>
        <span class="error">*</span><br><br>

        <label for="idSubject">Subject to enroll: </label>
        <select id="idSubject" name="subject" required>
            <option value="">Select option</option>
            <?php foreach ($asignaturas as $valor => $texto) { ?>
                <option value="<?php echo $valor; ?>" <?php if ((string)$valor === $subject) echo "selected"; ?>><?php echo $texto; ?></option>
            <?php } ?>
        </select>
        <span class="error">*</span><br><br>

        <?php foreach ($modalidades as $valor => $texto) { ?>
            <input type="radio" id="id-<?php echo $valor; ?>" name="modality" value="<?php echo $valor; ?>" required>
            <label for="id-<?php echo $valor; ?>"><?php echo $texto; ?> classes</label><br>
        <?php } ?>
        <br>

        <input type="submit" value="Send data">
    </form>
</body>
</html>

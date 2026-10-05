<?php require "datos.php"; ?>
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
        <label for="idName">Name and surnames: </label>
        <input type="text" id="idName" name="name" required>
        <span class="error">*</span><br><br>

        <label for="idSubject">Subject to enroll: </label>
        <select id="idSubject" name="subject" required>
            <option value="">Select option</option>
            <?php foreach ($asignaturas as $valor => $texto) { ?>
                <option value="<?php echo $valor; ?>"><?php echo $texto; ?></option>
            <?php } ?>
        </select>
        <span class="error">*</span><br><br>

        <input type="submit" value="Send data">
    </form>
</body>
</html>

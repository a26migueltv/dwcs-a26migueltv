<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process the form</title>
</head>
<body>
    <h1>SHOWING THE INFO FROM THE PREVIOUS FORM<h1>
    <?php
      $nome = $_POST["vName"];
      $email = $_POST["vEmail"];
      echo "<br>The name is: ".$nome;
      echo "<br>The email is: ".$email;
    ?>
    <br><br>
    <form action="seguintePaxina.php" method="get">
        <input type="hidden" id="idName" name="vName" value="<?php echo $nome;?>"><br><br>
        <input type="hidden" id="idmail" name="vEmail" value="<?php echo $email;?>"><br><br>
        <input type="submit" value="Seguinte páxina">
    </form>
    <a href="seguintePaxina.php?vName=<?php echo $nome;?>&vEmail=<?php echo $email;?>">Seguinte páxina.</a>
</body>
</html>
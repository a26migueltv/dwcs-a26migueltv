<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Example Page</title>
  </head>
  <body>
  <h1>Factorial of a number</h1>
  <?php
  // I'll calculate the factorial of the following number
  $numero = 5;
  $resultado = 1;
  for($i = $numero; $i>0; $i--){
  $resultado = $resultado * $i;
  }
  echo "<p>The result is: ".$resultado."</p>";
  ?>

  </body>
</html>

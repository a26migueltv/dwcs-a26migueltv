<?php

  class Expropia extends Exception {
 
    function __construct($message) {
      parent::__construct($message);
    }
  }

  class ExPropiaClass {
  
    public static function testNumber($num) {
      if ($num == 0) {
        
        throw new Expropia("The number can not be zero");
      }
      return "The number $num is valid";
    }
  }

  $numeros = [5, 0, -3, 0, 12];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Exceptions</title>
  <style>
    .error {color: #FF0000;}
  </style>
</head>
<body>
  <h2>Testing numbers</h2>
  <?php
  foreach ($numeros as $numero) {
    try {
      echo ExPropiaClass::testNumber($numero);
    } catch (Expropia $e) {
      echo "<span class=\"error\">" . "Exception caught: " . $e->getMessage() . "</span>";
    }
    echo "<br>";
  }
  ?>
</body>
</html>
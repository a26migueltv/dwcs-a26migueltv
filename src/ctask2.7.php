<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Sale</title>
  <style>
    .error {color: #FF0000;}
  </style>
</head>
<body>
  <?php
  $datos = [
    "cocacola" => ["texto" => "Coca Cola", "precio" => 2.1],
    "pepsicola" => ["texto" => "Pepsi Cola", "precio" => 2.],
    "fantanaranja" => ["texto" => "Fanta Naranja", "precio" => 2.5],
    "trimanzana" => ["texto" => "Trina Manzana", "precio" => 2.3]
  ];

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $bebida = $amount = "";
  $bebidaErr = $amountErr = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Check the drink exists
    if (empty($_POST["option"])) {
      $bebidaErr = "Drink is required";
    } else {
      $bebida = test_input($_POST["option"]);
      if (!isset($datos[$bebida])) {
        $bebidaErr = "That drink does not exist";
      }
    }
    
    if (empty($_POST["vamount"])) {
      $amountErr = "Amount is required";
    } else {
      $amount = test_input($_POST["vamount"]);
      if (filter_var($amount, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]) === false) {
        $amountErr = "Amount must be a whole number greater than 0";
      }
    }
    if ($bebidaErr == "" && $amountErr == ""){
      $total = $amount * $datos[$bebida]["precio"];
      echo "<h2>Your Order:</h2>";
      echo "You have asked for ".$amount." bottles of ".$datos[$bebida]["texto"].". Total price to pay: ".number_format($total, 2)." euros.";
    }
  }
  ?>
  <h1>SELECT DINAMICO</h1>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="idCompra">Compra: </label>
    <select id="idCompra" name="option">
    <?php
    foreach($datos as $valueDoSelect => $valor){ ?>
      <option value="<?php echo $valueDoSelect; ?>"><?php echo $valor["texto"]; ?> (<?php echo $valor["precio"]?> €)</option>
    <?php }
    ?>
    </select><br><br>
    <span class="error"><?php echo $bebidaErr; ?></span><br><br>
    <label for="idamount">Amount: </label>
    <input type="number" id="idamount" name="vamount"><br><br>
    <span class="error"><?php echo $amountErr; ?></span><br><br>
    <input type="submit" name="enviar" value="Send data">
  </form>
</body>
</html>
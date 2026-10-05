<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"
  </head>
  <body>
 <?php
  $datos = [
    "cocacola" => ["texto" => "Coca Cola", "precio" => 2.1],
    "pepsicola" => ["texto" => "Pepsi Cola", "precio" => 2.],
    "fantanaranja" => ["texto" => "Fanta Naranja", "precio" => 2.5],
    "trimanzana" => ["texto" => "Trina Manzana", "precio" => 2.3]
  ];

?>

    <h1>SELECT DINAMICO</h1>
    <form>
    <label for="idCompra">Compra</label>
    <select id="idcompra" name="option">
        

         <?php
            foreach($datos as $valueDoSelect => $valor){ ?>
                <option value="<?php echo $valueDoSelect; ?>"><?php echo $valor["texto"]; ?> (<?php echo $valor["precio"]?>)</option>
                 
 <?php }
        ?>
      
    </select>
    <label for = "idamount">Amount</label>
    <input type="number" id="idamount" name="vamount">
    <br><br><input type="submit" name="enviar" value="Send data">
</form>
  </body>
</html>
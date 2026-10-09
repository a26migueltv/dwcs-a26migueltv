<?php
  class Alien {
    private $name;
    // static: el atributo es de la CLASE, no de cada objeto.
    // Todos los Alien comparten el mismo contador.
    private static $numberOfAliens = 0;

    function __construct($name){
      $this->name = $name;
      // Cada vez que se crea un Alien, el contador sube 1
      self::$numberOfAliens++;
    }

    public function getName(){
      return $this->name;
    }

    // static: se llama con Alien::getNumberOfAliens(), sin necesitar un objeto
    public static function getNumberOfAliens(){
      return self::$numberOfAliens;
    }

  }//class
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aliens</title>
</head>
<body>
  <h2>Aliens</h2>
  <?php
  echo "Aliens created: " . Alien::getNumberOfAliens();
  echo "<br><br>";

  $alien1 = new Alien("Zork");
  echo "Created " . $alien1->getName() . ". Aliens created: " . Alien::getNumberOfAliens();
  echo "<br>";

  $alien2 = new Alien("Blip");
  echo "Created " . $alien2->getName() . ". Aliens created: " . Alien::getNumberOfAliens();
  echo "<br>";

  $alien3 = new Alien("Xenu");
  echo "Created " . $alien3->getName() . ". Aliens created: " . Alien::getNumberOfAliens();
  echo "<br><br>";

  echo "Total number of aliens: " . Alien::getNumberOfAliens();
  ?>
</body>
</html>

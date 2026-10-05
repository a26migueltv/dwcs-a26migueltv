<?php
  class Calculator {
    
    private $num1;
    private $num2;

   
    function __construct($num1 = 0, $num2 = 0){
      $this->num1 = $num1;
      $this->num2 = $num2;
    }

   
    function __toString()
    {
      return "Num1: $this->num1, Num2: $this->num2";
    }

    public function setNum1($num1){
      $this->num1 = $num1;
    }
    public function setNum2($num2){
      $this->num2 = $num2;
    }
    public function getNum1(){
      return $this->num1;
    }
    public function getNum2(){
      return $this->num2;
    }

    public function multiply(){
      return $this->num1 * $this->num2;
    }
    public function add(){
      return $this->num1 + $this->num2;
    }

  }

  
  $firstCalcule = new Calculator();
  $firstCalcule->setNum1(4);
  $firstCalcule->setNum2(7);

 
  $secondCalcule = new Calculator(5, 3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calculator</title>
</head>
<body>
  <h2>First calcule</h2>
  <?php
  echo "Num1: " . $firstCalcule->getNum1();
  echo "<br>";
  echo "Num2: " . $firstCalcule->getNum2();
  ?>

  <h2>Second calcule</h2>
  <?php
  echo $secondCalcule;
  echo "<br><br>";
  echo "Multiply: " . $secondCalcule->multiply();
  echo "<br>";
  echo "Add: " . $secondCalcule->add();
  ?>
</body>
</html>

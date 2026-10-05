<?php declare (strict_types=1);
function potencia(int $base, int $exp=2): int{
$resultado = 1;
if ($exp<0){
    throw new Exception("Only positive exp are possible");
}
for ($i=1; $i<=$exp; $i++){
$resultado = $resultado * $base;
    }
return $resultado;
 
 
}
 
?>
<!DOCTYPE html>
<html>
<head>
<title>Calculate Powers</title>
</head>
<body>
<h1>Calculate the power of two number</h1>
<?php
define("BASE",4);
define("EXP",3);
try{
$res = potencia(BASE, EXP);
echo "<p>The result is:" .$res."</p>";
}
catch (Exception | TypeError $e){
echo "<p>Error: " .$e->getMessage()."</p>";
}
?>
</body>
</html>

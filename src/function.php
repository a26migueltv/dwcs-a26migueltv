<?php declare (strict_types=1);
function mostrarPersona(?string $name, int $age, string $surname="Apelido"): void{
if ($name == null){
$name = "Nome";
}
echo "<p><b>" .$name." ".$surname." is ".$age." years old.</b></p>";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Show Person</title>
</head>
<body>
<h1>Show a person</h1>
<?php
try{
mostrarPersona("María", 25, "López");
mostrarPersona("Ana", 30);
mostrarPersona(null, 18);
mostrarPersona("Luis", "25");
}
catch (TypeError $e){
echo "<p>Error: " .$e->getMessage()."</p>";
}
?>
</body>
</html>
 

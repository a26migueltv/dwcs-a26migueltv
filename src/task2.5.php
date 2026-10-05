<!DOCTYPE html>
<html lang="es">
<?php
// Función 1: comproba se hai un valor repetido tres veces seguidas
function triplecheck(array $numbers): bool {
    $count = 0;
    $triple = false;
    $anterior = null; 
 
    foreach ($numbers as $num) {
        if ($num === $anterior) $count++;
        else $count = 0;
 
        if ($count == 2) {
            $triple = true;
            break;
        }
        $anterior = $num;
    }
    return $triple;
}
 
// Función 2: amosa país e capital, ordenado por capital
function countries(array $paises): void {
    asort($paises); 
    foreach ($paises as $pais => $capital) {
        echo "The capital of $pais is $capital<br>";
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Working with arrays</title>
</head>
<body>
    <h1>Working with arrays</h1>
 
    <h2>1. tripleCheck</h2>
    <?php
    echo "<p>Caso 1</p>";
    $caso1 = array(1, 1, 2, 2, 1);
    var_dump(triplecheck($caso1));
 
    echo "<p>Caso 2</p>";
    $caso2 = array(1, 1, 2, 1, 2, 3);
    var_dump(triplecheck($caso2));
 
    echo "<p>Caso 3</p>";
    $caso3 = array(1, 1, 1, 2, 2, 2, 1);
    var_dump(triplecheck($caso3));
 
    if (triplecheck($caso3))
        echo "<br><br>No terceiro caso hai un triple";
    ?>
 
    <h2>2. countries</h2>
    <?php
    $ceu = array(
        "Italy" => "Rome", "Luxembourg" => "Luxembourg", "Belgium" => "Brussels",
        "Denmark" => "Copenhagen", "Finland" => "Helsinki", "France" => "Paris",
        "Slovakia" => "Bratislava", "Slovenia" => "Ljubljana", "Germany" => "Berlin",
        "Greece" => "Athens", "Ireland" => "Dublin", "Netherlands" => "Amsterdam",
        "Portugal" => "Lisbon", "Spain" => "Madrid", "Sweden" => "Stockholm",
        "United Kingdom" => "London", "Cyprus" => "Nicosia", "Lithuania" => "Vilnius",
        "Czech Republic" => "Prague", "Estonia" => "Tallin", "Hungary" => "Budapest",
        "Latvia" => "Riga", "Malta" => "Valetta", "Austria" => "Vienna", "Poland" => "Warsaw"
    );
    countries($ceu);
    ?>
</body>
</html>

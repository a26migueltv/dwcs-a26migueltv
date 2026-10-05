<?php

$host = getenv('DB_HOST');
$db = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h1>¡PHP funciona!</h1>";
    echo "<p>Conexión con MySQL: OK</p>";

} catch (PDOException $e) {
    echo "<h1>Error de conexión</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}


<?php

$asignaturas = [
    0 => "Java Programming",
    1 => "Web Design",
    2 => "Dockers administration",
    3 => "Django framework",
    4 => "Mongo database"
];


$modalidades = [
    "in-person" => "In-person",
    "distance"  => "Distance"
];

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

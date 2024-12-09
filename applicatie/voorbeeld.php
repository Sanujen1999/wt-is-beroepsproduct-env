<?php
$voornaam = 'Peter';
$achternaam = 'Pan';

$naam = "{$voornaam} {$achternaam} ";

$vandaag = date_create('now');
$datum = $vandaag->format('d-M-Y');


var_dump($voornaam);


?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>PHP voorbeeld</title>
</head>
<body>
    Hallo <?= $naam ?>.<br>
    Het is vandaag <?= $datum ?>.


</body>
</html>

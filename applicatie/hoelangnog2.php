<?php

if (isset($_GET['omschrijving'], $_GET['datum'])) {
    $omschrijving = $_GET['omschrijving']; // Gebruik de juiste parameter
    $datum = $_GET['datum']; // Gebruik de juiste parameter
} else {
    echo "De opgegeven datum voor $omschrijving is al verstreken.";
    echo "De opgegeven datum is ongeldig.";
  
}


// var_dump($datum);
$date1=date_create("now");
$date2=date_create("05-12-2025");
$diff=date_diff($date1,$date2);


$aantaldagen = $diff->format(format: "Sinterklaas duurt %r%a dagen en %h uren") 


?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>PHP voorbeeld</title>
</head>
<body>
 
<?= $aantaldagen ?>



</body>
</html>
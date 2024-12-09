<?php

$date1=date_create("now");
$date2=date_create("05-12-2025");
$diff=date_diff($date1,$date2);

$aantaldagen = $diff->format(format: "Sinterklaas duurt %r%a dagen en %h uren") . '<br>';


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
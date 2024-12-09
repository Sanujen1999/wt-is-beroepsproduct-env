<?php

$date1=date_create("now");
$date2=date_create("05-12-2024");
$diff=date_diff($date1,$date2);



?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>PHP voorbeeld</title>
</head>
<body>
 
<?php
echo 'Sinterklaas duurt nog '. $diff->format(" %a dagen en %h uren") . '<br>';
  
?>


</body>
</html>
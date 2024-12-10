<?php
require_once 'db_connectie.php';
require_once '../applicatie/library/db_functie.php';

$db = maakVerbinding();
echo 'GELUKT';
?>

<body>

    <?php
 
echo KiesTabel($db,'stuk');
echo KiesTabel($db,'componist');

?>

</body>
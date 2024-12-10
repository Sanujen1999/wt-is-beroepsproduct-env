<?php
require_once 'db_connectie.php';
$db = maakVerbinding();
echo 'GELUKT';


$sql = 'select * from stuk';
$dataset = $db->query($sql);
// var_dump($data);

foreach ($dataset as $row) {
    // echo $row['titel'].'<br>';
    $html = '<table>';

    for ($i = 0; $i < 8; $i++) {
        $html .= "<tr><td>$i</td></tr>";
        echo $row[$i] . '<br>';
    }
    $html .= '</table>';
    return $html;  
    // var_dump($row);
    // foreach($row as $column){
    //     var_dump(value:$column);
    // }

}

<?php
$sql = 'select * from stuk';
$db = maakVerbinding();
$dataset = $db->query($sql);
// var_dump($data);
 
function toonTabelInhoud($dataset)
{


    $html = '';

    $html .= '<table>';
    foreach ($dataset as $row) {
        // Generate a table row for each row in the dataset
        $html .= '<tr>';
        // Correcting the logic for looping through columns
        for ($i = 0; $i < (count(value: $row) / 2); $i++) {
            $html .= '<td>' . $row[$i] . '</td>';
        }
        $html .= '</tr>';
    }
    $html .= '</table>';

    return $html;
}

function KiesTabel($db,$tabel)
{
    $sql = "select * from {$tabel}";
    $dataset = $db->query($sql);

    $html = "<h2>{$tabel}</h2>";
    $html .= toonTabelInhoud($dataset);
    return $html;
}

?>
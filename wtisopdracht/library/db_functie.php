<?php
$sql = 'select * from stuk';
$db = maakVerbinding();
$dataset = $db->query($sql);
// var_dump($data);
 

function KiesTabel($db, $tabel)
{
    $sql = "select * from {$tabel}";
    $dataset = $db->query($sql);

    $html = "<h2>{$tabel}</h2>";
    $html .= toonTabelInhoud($dataset);
    return $html;
}

function toonTabelInhoud($dataset)
{
    $html = '<table>';
    $html .= '<thead>';
    $html .= '<tr>';
    for ($i = 0; $i < $dataset->columnCount(); $i++) {
        $col = $dataset->getColumnMeta($i);
        $html .= '<th>' . $col['name'] . '</th>';
    }
    $html .= '</tr></thead>';
    $html .= '<tbody>';

    foreach ($dataset as $row) {
        $html .= '<tr>';
        for ($i = 0; $i < (count($row)) / 2; $i++) {
            $html .= '<td>' . $row[$i] . '</td>';
        }
        $html .= '</tr>';
    }

    $html .= '</tbody>';
    $html .= '</table>';
    return $html; // Zorg dat de tabel wordt teruggegeven
}

// Een voorbeeld aanroep:
echo KiesTabel($db, 'stuk,componist,niveau');
?>
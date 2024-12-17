<?php
require_once 'db_connectie.php';
$db = maakVerbinding();
// var_dump($_GET);
 
if (isset($_GET['genrenaam'])){
    $genrenaam = $_GET['genrenaam'];
} else{
    $genrenaam = '';
}
$sql = "
    SELECT 
        s.stuknr, 
        s.titel, 
        s.genrenaam, 
        n.omschrijving AS niveau_omschrijving, 
        c.naam AS componist_naam
    FROM Stuk AS s
    LEFT JOIN Niveau AS n ON s.niveaucode = n.niveaucode
    INNER JOIN Componist AS c ON s.componistId = c.componistId
    WHERE s.genrenaam LIKE :genrenaam
";
$dataset = $db->prepare($sql);
$dataset->execute(
    [
        'genrenaam' => '%' . $genrenaam . '%'
    ]
);
function getGenreSelectBox($selection)
{
    // Toevoegen: geef het geselecteerde genre `selected`

    $db = maakVerbinding();
    $sql = 'select genrenaam 
            from Genre';
    $data = $db->query($sql);

    $selectbox = '<select id="genrenaam" name="genrenaam">';
    foreach($data as $rij)
    {
        $genrenaam = $rij['genrenaam'];
        $selectbox .= "<option value=\"$genrenaam\">$genrenaam</option>";
 
    }
    $selectbox .= '</select>';

    return $selectbox;
}


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
?>

<html>
<body>
<form action="toontabel.php">
  <label for="genrenaam" name="genrenaam" id="genrenaam">Kies genrenaam</label>
  <?php echo getGenreSelectBox($genrenaam);?>
  <input type="submit" value="Submit">
  <?php echo toonTabelInhoud($dataset); ?>
</form>
</body>
</html>









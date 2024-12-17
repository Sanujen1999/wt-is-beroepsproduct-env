<?php
require_once 'db_connectie.php';


// 4 kolommen, dus ook 4 variabelen
$componistId    = isset($_POST['componistId']) ? $_POST['componistId'] : '';
$naam           = isset($_POST['naam']) ? $_POST['naam'] : '';
$geboortedatum  = isset($_POST['geboortedatum']) ? $_POST['geboortedatum'] : '';
$schoolId       = isset($_POST['schoolId']) ? $_POST['schoolId'] : '';

 

// Controleer niet verplichte velden
if (empty($geboortedatum)) {
    $geboortedatum = null;
}
// Controleer niet verplichte velden
if (empty($schoolId)) {
    $schoolId = null;
}

$db = maakVerbinding();
$sql = "INSERT INTO componist (componistId, naam, geboortedatum, schoolId) 
VALUES (:componistId, :naam, :geboortedatum, :schoolId)";

$query = $db->prepare($sql);
$data_array = [
    'componistId' => $componistId,
    'naam' => $naam,
    'geboortedatum' => $geboortedatum,
    'schoolId' => $schoolId,
];

$succes = $query->execute($data_array);

if ($succes) {
    $melding = 'Gegevens zijn opgeslagen';
}else{
    $melding = 'Niet opgeslagen';
}

$fouten = [];
// Controleer velden op geldigheid
// componist id (not null, numeric)
if (empty($componistId)) {
    $fouten[] = 'componistId is verplicht om in te vullen.';
}

if (!is_numeric($componistId)) {
    $fouten[] = 'componistId moet een numerieke waarde zijn.';
}

// Naam (not null, text)
if (empty($naam)) {
    $fouten[] = 'naam is verplicht om in te vullen.';
}

if (count($fouten) > 0) {
    // Fouten: maak een melding
    $melding = '<ul class="error">';

    foreach($fouten as $fout)
    {
        $melding .= '<li>'.$fout.'</li>';

    }
    $melding .= '</ul>';
} else
{
    // ....... opslaan in db
}

echo $melding
?>

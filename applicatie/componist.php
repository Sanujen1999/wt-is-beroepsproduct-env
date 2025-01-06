<?php

function sanitize($string){
    return htmlspecialchars(strip_tags($string));
}

require_once 'db_connectie.php';
$fouten = array();

// 4 kolommen, dus ook 4 variabelen
if(isset($_POST['opslaan'])) {
$componistId    =  sanitize($_POST['componistId']) ;
$naam           =  sanitize($_POST['naam']);
$geboortedatum  = sanitize($_POST['geboortedatum']) ;
$schoolId       = sanitize($_POST['schoolId']) ;

$hash = password_hash($password, PASSWORD_DEFAULT);

$melding = "insert into login('username,password') values (':username,:password')";


}
function getSchoolIdSelectBox()
{
 
    $db = maakVerbinding();
    $sql = 'select schoolID 
            from componist';
    $data = $db->query($sql);

    $selectbox = '<select id="schoolID" name="schoolID">';
    foreach($data as $rij)
    {
        $schoolID = $rij['schoolID'];
        $selectbox .= "<option value=\"$schoolID\">$schoolID</option>";
 
    }
    $selectbox .= '</select>';

    return $selectbox;
}

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

// Controleer niet verplichte velden
if (empty($geboortedatum)) {
    $geboortedatum = null;
}
// Controleer niet verplichte velden
if (empty($schoolId)) {
    $schoolId = null;
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
}



echo $melding

?>

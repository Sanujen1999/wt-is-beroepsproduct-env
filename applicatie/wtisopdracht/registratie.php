

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
    $sql = 'select * from User where username = :username';
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

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../beroepsproduct-wtux-Sanujen1999/CSS/normalize.css">
    <link rel="stylesheet" href="../beroepsproduct-wtux-Sanujen1999/CSS/style.css">
    <title>Registratie</title>
  </head>
  
 

<body>
    <header>
        <div>
          <a href="index.html"> <img src="Images/Logopizza.jpg" alt="logo" class="logo"></a>
        </div>
    <div>
      <a href="profiel.html"> <img src="Images/profiel.jpg" alt="logo" class="icon"></a>
      <a href="winkelmand.html"> <img src="Images/winkelmandje.jpg" alt="logo" class="icon" ></a>
    </div>
      </header>
      <div class="navbar">
        <a href="assortiment.html">Assortiment pizza</a>
            <a href="login.html">Login</a>
          </div>
    <main>
        <div class="form-box">
            <h2>Registreren</h2>
            <form>
                <div class="form-group">
                    <label for="register-name">Naam</label>
                    <input type="text" id="register-name" placeholder="Voer je naam in" required>
                </div>
                <div class="form-group">
                    <label for="register-email">E-mailadres</label>
                    <input type="email" id="register-email" placeholder="Voer je e-mailadres in" required>
                </div>
                <div class="form-group">
                    <label for="register-password">Wachtwoord</label>
                    <input type="password" id="register-password" placeholder="Kies een wachtwoord" required>
                </div>

                <div class="form-group">
                    <label for="register-postcode">Postcode</label>
                    <input type="text" id="register-postcode" placeholder="Voer je Postcode" required>
                </div>


                <div class="form-group">
                    <label for="register-straatnaam">Straatnaam en huisnummer</label>
                    <input type="text" id="register-straatnaam" placeholder="Voer je Straatnaam en huisnummer" required>
                </div>

                <div class="form-group">
                    <label for="register-woonplaats">Woonplaats</label>
                    <input type="text" id="register-woonplaats" placeholder="Voer je Woonplaats in " required>
                </div>
                <button type="submit" class="form-button">Registreren</button>
            </form>
        </div>
    </main>
    <footer class="footer">
        <div class="footer-container">
          <div class="footer-item">
            <h3>Over ons</h3>
            <p>De beste pizza `s van de hele wereld. </p>
          </div>
    
          <div class="footer-item">
            <h3>Overig</h3>
            <ul>
              <li><a href="overons.html">Over ons</a></li>
              <li><a href="privacy.html">Juridische verklaring</a></li>
            </ul>
          </div>
          <div class="footer-item">
            <h3>Contact</h3>
            <p>Email: support@pizza.com</p>
            <p>Phone: (123) 456-7890</p>
          </div>
        </div>
      </footer>
</body>
</html>
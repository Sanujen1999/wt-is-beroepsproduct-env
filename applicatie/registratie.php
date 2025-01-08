<?php
require_once '../wtisopdracht/library/db_connectie.php';

$melding = '';  // Initialisatie melding

// Check of het formulier is ingediend
if (isset($_POST['registeren'])) {
    $fouten = [];

    // 1. Inlezen gegevens uit het formulier
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $adress = trim($_POST['adress'] ?? '');
    $role = trim($_POST['role'] ?? '');

    // 2. Controleer of de gegevens geldig zijn
    if (empty($username) || strlen($username) < 4) {
        $fouten[] = 'Gebruikersnaam moet minstens 4 karakters bevatten.';
    }

    if (empty($password) || strlen($password) < 8) {
        $fouten[] = 'Wachtwoord moet minstens 8 karakters bevatten.';
    }

    if (empty($first_name)) {
        $fouten[] = 'Voornaam is verplicht.';
    }

    if (empty($last_name)) {
        $fouten[] = 'Achternaam is verplicht.';
    }


    // Controleer of er fouten zijn
    if (count($fouten) > 0) {
        $melding = "Er waren fouten in de invoer:<ul>";
        foreach ($fouten as $fout) {
            $melding .= "<li>$fout</li>";
        }
        $melding .= "</ul>";
    } else {
        // 3. Gegevens opslaan
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);

        // Databaseverbinding maken
        $db = maakVerbinding();

        // Insert-query voorbereiden
        $sql = 'INSERT INTO [User](username, password, first_name, last_name,role)
        VALUES (:username, :password, :first_name, :last_name,  :role)';
        
        $query = $db->prepare($sql);

        // Data array voorbereiden
        $data_array = [
            'username' => $username,
            'password' => $passwordhash,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'role' => 'Client'
        ];

        // Gegevens invoegen
        $succes = $query->execute($data_array);

        if ($succes) {
            $melding = 'Gebruiker is succesvol geregistreerd.';
        } else {
            $melding = 'Registratie is mislukt. Probeer het opnieuw.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../wtisopdracht/CSS/normalize.css">
    <link rel="stylesheet" href="../wtisopdracht/CSS/style.css">
    <title>Registratie</title>
</head>

<body>
    <header>
        <div>
            <a href="index.html"> <img src="Images/Logopizza.jpg" alt="logo" class="logo"></a>
        </div>
        <div>
            <a href="profiel.html"> <img src="Images/profiel.jpg" alt="logo" class="icon"></a>
            <a href="winkelmand.html"> <img src="Images/winkelmandje.jpg" alt="logo" class="icon"></a>
        </div>
    </header>
    <div class="navbar">
        <a href="assortiment.html">Assortiment pizza</a>
        <a href="login.php">Login</a>
    </div>
    <main>
        <div class="form-box">
            <h2>Registreren</h2>
            <?php if (!empty($melding)): ?>
                <div class="melding">
                    <?php echo $melding; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Naam</label>
                    <input type="text" id="username" name="username" placeholder="Voer je naam in" required>
                </div>

                <div class="form-group">
                    <label for="password">Wachtwoord</label>
                    <input type="password" id="password" name="password" placeholder="Kies een wachtwoord" required>
                </div>

                <div class="form-group">
                    <label for="first_name">Voornaam</label>
                    <input type="text" id="first_name"  name="first_name" placeholder="Voer je Voornaam in" required>
                </div>


                <div class="form-group">
                    <label for="last_name">Achternaam</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Voer je Achternaam" required>
                </div>

                <button type="submit" class="form-button" name="registeren">Registreren</button>
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
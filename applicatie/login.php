<?php
session_start();

$logged_in = false;
$html = "";

// Controleer of er een POST-verzoek is om in te loggen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Controleer of username en pass zijn ingevuld
    if (!empty($_POST['username']) && !empty($_POST['pass'])) {
        // Haal de ingevoerde waardes op
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['pass']);

        // Voor nu simuleren we gebruikerscontrole (gebruik een echte database in productie)
        $valid_username = "admin";
        $valid_password = "password123";

        if ($username === $valid_username && $password === $valid_password) {
            // Sla gebruikersinformatie op in de sessie
            $_SESSION['username'] = $username;
            $logged_in = true;
            $html = "<h1>Welcome {$username}</h1>";
        } else {
            echo "<p>Invalid username or password. Please try again.</p>";
        }
    } else {
        echo "<p>Please fill in both username and password.</p>";
    }
}

// Controleer of er al een sessie actief is
if (isset($_SESSION['username'])) {
    $logged_in = true;
    $html = "<h1>Welcome {$_SESSION['username']}</h1>";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testsessie</title>
</head>
<body>
    <?php
    if ($logged_in) {
        echo $html;
    } else {
    ?>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <label for="pass">Password:</label>
        <input type="password" name="pass" id="pass" required>
        <input type="submit" value="Login">
    </form>
    <?php
    }
    ?>
    <a href="logout.php">Log uit</a>
</body>
</html>


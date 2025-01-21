<?php
require_once '../applicatie/library/db_connectie.php';
session_start();
$db = maakVerbinding();
$logged_in = false;
$html = "";

// Controleer of er een POST-verzoek is om in te loggen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Controleer of username en pass zijn ingevuld
  if (!empty($_POST['username']) && !empty($_POST['password'])) {
    // Haal de ingevoerde waardes op
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // echo "Gebruikersnaam: " . $username . "<br>"; 
    // echo "Wachtwoord: " . $password . "<br>";

    // Voor nu simuleren we gebruikerscontrole (gebruik een echte database in productie)
    $sql = "SELECT password FROM [User] WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $hashed_password = $stmt->fetchColumn();
 
    if ($stmt->rowCount() > 0) {
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $hashed_password = $result['password'];
    }
      if ($hashed_password && password_verify($password, $hashed_password)) {
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
  $username = $_SESSION['username']; 
  $html = "<h1>Welcome {$_SESSION['username']}</h1>";
  $html .= '<a href="logout.php">Logout</a>';
} 
 



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/normalize.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <title>Registratie</title>
</head>

<body>
  <header>
    <div>
      <a href="index.php"> <img src="Images/Logopizza.jpg" alt="logo" class="logo"></a>
    </div>
    <div>
      <a href="profiel.php"> <img src="Images/profiel.jpg" alt="logo" class="icon"></a>
      <a href="winkelmand.php"> <img src="Images/winkelmandje.jpg" alt="logo" class="icon"></a>
    </div>
  </header>
  <div class="navbar">
    <a href="assortiment.php">Assortiment pizza</a>
    <a href="bestellingoverzicht.php">Bestellingoverzicht</a>
    <a href="detailoverzicht.php">Detail overzicht</a>
    <a href="login.php">Login</a>
  </div>
  <main>
    <div class="form-container">
      <!-- Login Form -->
      <div class="form-box">
        <h2>Login</h2>
        <?php echo $html; ?> <?php if (!$logged_in): ?>
          <form method="POST" action="">
            <div class="form-group">
              <label for="username">Gebruikersnaam</label>
              <input type="text" id="username" name="username" placeholder="Voer je gebruikersnaam in" required>
            </div>
            <div class="form-group">
              <label for="password">Wachtwoord</label>
              <input type="password" id="password" name="password" placeholder="Voer je wachtwoord in" required>
            </div>
            <a href="registratie.php">Registreer je hier</a>
            <button type="submit" class="form-button">Inloggen</button>
          </form>
        <?php endif; ?>
      </div>
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
          <li><a href="overons.php">Over ons</a></li>
          <li><a href="privacy.php">Juridische verklaring</a></li>
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
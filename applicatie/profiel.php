<?php
// Vereis databaseverbinding
require_once '../applicatie/library/db_connectie.php';
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}

// Maak databaseverbinding via de functie uit db_connectie.php
$db = maakVerbinding();
$orders = [];

// Statusmapping
$statusMapping = [
  1 => 'Ontvangen',
  2 => 'In Behandeling',
  3 => 'Gereed',
  4 => 'Bezorgd'
];

// Haal bestellinggegevens op voor de ingelogde gebruiker
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $sql = "SELECT order_id, datetime, status FROM Pizza_Order WHERE client_username = :username";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
  $stmt->execute();
  $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/normalize.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <title>Profiel</title>
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
    <a href="login.php">Login</a>
  </div>
  <main class="container">
    <div class="orders">
      <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $order): ?>
          <div class="order">
            <div class="order-info">
              <h2>Bestelling #<?= htmlspecialchars($order['order_id']) ?></h2>
              <p>Datum: <?= htmlspecialchars($order['datetime']) ?></p>
              <p>Status: <?= htmlspecialchars($statusMapping[$order['status']]) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Geen bestellingen gevonden.</p>
      <?php endif; ?>
    </div>
  </main>
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-item">
        <h3>Over ons</h3>
        <p>De beste pizza's van de hele wereld.</p>
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
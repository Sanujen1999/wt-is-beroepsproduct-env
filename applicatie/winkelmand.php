<?php
require_once '../applicatie/library/db_connectie.php';
session_start();
$db = maakVerbinding();

// Controleer of de winkelmand bestaat en haal de inhoud op
$winkelmand = isset($_SESSION['winkelmand']) ? $_SESSION['winkelmand'] : [];

// Verwijder een specifiek item uit de winkelmand
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
  $index = $_POST['remove'];
  unset($winkelmand[$index]); // Verwijder item
  $_SESSION['winkelmand'] = array_values($winkelmand); // Herindexeer array
  header('Location: winkelmand.php'); // Vernieuw de pagina
  exit;
}

// Haal alle bestellingen op uit de database
$sql = "SELECT order_id, product_name, quantity FROM Product";
$stmt = $db->prepare($sql);

try {
    $stmt->execute();
    $bestellingen = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Fout bij het ophalen van bestellingen: ' . $e->getMessage();
    $bestellingen = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/normalize.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <title>Winkelmand</title>
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
  <main>
    <div class="cart-container">
      <h1>Winkelmandje</h1>

      <?php if (empty($winkelmand)): ?>
        <p>Je winkelmandje is leeg. <a href="assortiment.php">Ga terug naar het assortiment</a>.</p>
      <?php else: ?>
        <?php foreach ($winkelmand as $index => $item): ?>
          <div class="cart-item">
            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
            <div class="item-details">
              <h3><?= htmlspecialchars($item['name']) ?></h3>
              <p class="price">€<?= number_format($item['price'], 2) ?></p>
              <p>Aantal: <span class="quantity"><?= htmlspecialchars($item['quantity']) ?></span></p>
            </div>
          </div>
          <form method="POST">
            <button type="submit" name="remove" value="<?= $index ?>" class="remove-button">Verwijderen</button>
            <?php endforeach; ?>
  <div class="cart-summary">
    <p>
      Totaal:
      <span class="total-price">€
        <?= number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $winkelmand)), 2) ?>
      </span>
    </p>
    <button class="checkout-button">Afrekenen</button>
  </div>
<?php endif; ?>
          </form>
    </div>

  <div class="bestellingen-container">
    <h2>Eerdere bestellingen</h2>
    <?php if (empty($bestellingen)): ?>
      <p>Geen eerdere bestellingen gevonden.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Productnaam</th>
            <th>Hoeveelheid</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($bestellingen as $bestelling): ?>
            <tr>
              <td><?= htmlspecialchars($bestelling['order_id']) ?></td>
              <td><?= htmlspecialchars($bestelling['product_name']) ?></td>
              <td><?= htmlspecialchars($bestelling['quantity']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
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

<?php
require_once '../applicatie/library/db_connectie.php';

session_start();

$db = maakVerbinding();
$query = "SELECT name, price, type_id FROM Product";
$stmt = $db->query($query);
$producten = $stmt->fetchAll();

function generateOrderId() {
  return uniqid('order_', true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $pizza = $_POST['name'];
  $price = $_POST['price'];
  $image = $_POST['type_id'];
  $order_id = generateOrderId();

  // Controleer of winkelmand al bestaat
  if (!isset($_SESSION['winkelmand'])) {
    $_SESSION['winkelmand'] = [];
  }

  // Controleer of de pizza al in de winkelmand zit
  $found = false;
  foreach ($_SESSION['winkelmand'] as &$item) {
    if ($item['name'] === $pizza) {
      // Verhoog de hoeveelheid als het item al bestaat
      $item['quantity'] += 1;
      $found = true;
      break;
    }
  }

  // Voeg het item toe als het niet bestaat
  if (!$found) {
    $_SESSION['winkelmand'][] = [
      'name' => $pizza,
      'price' => $price,
      'image' => $image,
      'quantity' => 1,
    ];
  }

  // Doorsturen naar winkelmand
  header('Location: winkelmand.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/normalize.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <title>Assortiment</title>
</head>

<body>
  <header>
    <div>
      <a href="index.php"> <img src="Images/Logopizza.jpg" alt="logo" class="logo"></a>
    </div>
    <div>
      <a href="profiel.php"> <img src="Images/profiel.jpg" alt="profiel" class="icon"></a>
      <a href="winkelmand.php"> <img src="Images/winkelmandje.jpg" alt="winkelmand" class="icon"></a>
    </div>
  </header>
  <div class="navbar">
    <a href="assortiment.php">Assortiment pizza</a>
    <a href="login.php">Login</a>
  </div>

  <main>
    <h1>Pizza Keuze</h1>
    <p class="openingzin">De keuzemenu</p>
    <div class="pizza-container">
      <?php if ($producten): ?>
        <?php foreach ($producten as $product): ?>
          <div class="pizza-card">
            <img src="<?= htmlspecialchars($product['type_id']); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
            <h3><?= htmlspecialchars($product['name']); ?></h3>
            <p>Prijs: €<?= htmlspecialchars($product['price']); ?></p>
            <form method="POST">
              <input type="hidden" name="name" value="<?= htmlspecialchars($product['name']); ?>">
              <input type="hidden" name="price" value="<?= htmlspecialchars($product['price']); ?>">
              <input type="hidden" name="type_id" value="<?= htmlspecialchars($product['type_id']); ?>">
              <button type="submit" class="order-button">Bestellen</button>
            </form>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Geen producten gevonden.</p>
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
          <li><a href="overons.html">Over ons</a></li>
          <li><a href="privacy.html">Juridische verklaring</a></li>
        </ul>
      </div>
      <div class="footer-item">
        <h3>Contact</h3>
        <p>Email: support@pizza.com</p>
        <p>Telefoon: (123) 456-7890</p>
      </div>
    </div>
  </footer>
</body>

</html>

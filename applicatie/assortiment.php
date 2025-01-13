<?php
require_once '../applicatie/library/db_connectie.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pizza = $_POST['pizza'];
    $price = $_POST['price'];
    $image = $_POST['image'];

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
            'quantity' => 1, // Standaard aantal
        ];
    }

    // Doorsturen naar winkelmand
    header('Location: winkelmand.php');
    exit;
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
  <title>Assortiment</title>
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
    <h1>Pizza Keuze</h1>
    <p class="openingzin">De keuzemenu</p>
    <div class="pizza-container">
      <!-- Pizza Margherita -->
      <div class="pizza-card">
        <img src="Images/pizzamagaritha.jpg" alt="Pizza Margherita">
        <h3>Margherita pizza</h3>
        <p>Klassieke pizza met tomatensaus, mozzarella, basilicum en olijfolie.</p>
        <ul class="recipe-list">
          <li>Tomatensaus</li>
          <li>Mozzarella</li>
          <li>Basilicum</li>
          <li>Olijfolie</li>
        </ul>
        <form method="POST">
    <input type="hidden" name="pizza" value="Pizza Margherita">
    <input type="hidden" name="price" value="9.99">
    <input type="hidden" name="type_id" value="Images/pizzamagaritha.jpg">
    <button type="submit" class="order-button">Bestellen</button>
</form>

      </div>
      <!-- Pizza Pepperoni -->
      <div class="pizza-card">
        <img src="Images/peperonipizza.jpg" alt="Pepperoni Pizza">
        <h3>Pepperoni pizza</h3>
        <p>Geladen met pepperoni en kaas.</p>
        <ul class="recipe-list">
          <li>Tomatensaus</li>
          <li>Mozzarella</li>
          <li>Pepperoni</li>
          <li>Oregano</li>
        </ul>
        <form method="POST">
          <input type="hidden" name="pizza" value="Pepperoni Pizza">
          <button type="submit" class="order-button">Bestellen</button>
        </form>
      </div>
      <!-- Pizza Shoarma -->
      <div class="pizza-card">
        <img src="Images/pizzashoarma.jpg" alt="Shoarma Pizza">
        <h3>Shoarma pizza</h3>
        <p>Een mix van verse kip en knoflooksaus.</p>
        <ul class="recipe-list">
          <li>Kip</li>
          <li>Knoflook</li>
          <li>Kaas</li>
          <li>Uien</li>
        </ul>
        <form method="POST">
          <input type="hidden" name="pizza" value="Shoarma Pizza">
          <button type="submit" class="order-button">Bestellen</button>
        </form>
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

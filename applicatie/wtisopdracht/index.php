<?php


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../wtisopdracht/CSS/normalize.css">
  <link rel="stylesheet" href="../wtisopdracht/CSS/style.css">
  <title>Pizzaria Sole Machina</title>
</head>

<body>
  <header>
    <div>
      <a href="index.html"><img src="Images/Logopizza.jpg" alt="logo" class="logo"></a>
    </div>
<div>
  <a href="profiel.html"> <img src="Images/profiel.jpg" alt="logo" class="icon"></a>
  <a href="winkelmand.html"> <img src="Images/winkelmandje.jpg" alt="logo" class="icon" ></a>
</div>
  </header>
  <div class="navbar">
    <a href="assortiment.html">Assortiment pizza</a>
        <a href="login.php">Login</a>
        <a href="bestellingoverzicht.html">Bestelling overzicht</a>
        <a href="detailoverzicht.html">Detailoverzicht </a>
      </div>
  <main>
    <h1>Pizzaria Sole Machina</h1>
    <p class="openingzin">De bestsellers zie je hieronder</p>
    <div class="pizza-container">
      <div class="pizza-card">
          <img src="Images/pizzamagaritha.jpg" alt="Pizza Margherita">
          <h3>Margherita pizza</h3>
          <p>klassieke pizza met tomaten saus, mozzarella, basilicum en olijf olie</p>
          <ul class="recipe-list">
              <li>Tomaten saus</li>
              <li>Mozzarella</li>
              <li>basilicum</li>
              <li>Olijf olie</li>
          </ul>
          <p class="price">€15.00</p>
          <button class="order-button">Bestellen</button>
      </div>
      <div class="pizza-card">
          <img src="Images/peperonipizza.jpg" alt="Pepperoni Pizza">
          <h3>Pepperoni pizza</h3>
          <p>geladen met pepperoni en kaas.</p>
          <ul class="recipe-list">
              <li>Tomaten saus</li>
              <li>Mozzarella</li>
              <li>Pepperoni</li>
              <li>Oregano</li>
          </ul>
          <p class="price">€20.00</p>
          <button class="order-button">Bestellen</button>
      </div>
      <div class="pizza-card">
          <img src="Images/pizzashoarma.jpg" alt="Shoarma Pizza">
          <h3>Shoarma pizza</h3>
          <p>A mix of verse chicken and knofloksaus</p>
          <ul class="recipe-list">
              <li>Kip</li>
              <li>Knoflook</li>
              <li>Kaas</li>
              <li>Uien</li>
          </ul>
          <p class="price">€18.00</p>
          <button class="order-button">Bestellen</button>
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/normalize.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Detailoverzicht</title>
</head>

<body>
    <header>
        <div>
            <a href="index.php"> <img src="Images/Logopizza.jpg" alt="logo" class="logo"></a>
        </div>
        <div>
            <a href="profiel.php"> <img src="Images/profiel.jpg" alt="logo" class="icon"></a>
        </div>
    </header>
    <div class="navbar">
        <a href="assortiment.php">Assortiment pizza</a>
        <a href="login.php">Login</a>
    </div>
    <main class="detail-container">
        <!-- Bestellingsinformatie -->
        <section class="detail-info">
            <h2>Bestellingsinformatie</h2>
            <p><strong>Bestelling ID:</strong> #001</p>
            <p><strong>Klantnaam:</strong> Jan Jansen</p>
            <p><strong>Telefoonnummer:</strong> 0612345678</p>
            <p><strong>Adres:</strong> Voorbeeldstraat 123, 1234 AB, Amsterdam</p>
        </section>

        <!-- Pizza details -->
        <section class="detail-pizzas">
            <h2>Gekozen Pizza's</h2>
            <ul class="pizza-list">
                <li>
                    <img src="Images/pizzamagaritha.jpg" alt="Margherita Pizza" class="pizza-image">
                    <span>Margherita - 1x</span>
                </li>
                <li>
                    <img src="Images/peperonipizza.jpg" alt="Pepperoni Pizza" class="pizza-image">
                    <span>Pepperoni - 2x</span>
                </li>
                <li>
                    <img src="Images/pizzashoarma.jpg" alt="Hawaii Pizza" class="pizza-image">
                    <span>Shoarma - 1x</span>
                </li>
            </ul>
        </section>

        <!-- Acties voor bezorger -->
        <section class="detail-actions">
            <h2>Acties</h2>
            <button class="action-button complete">Bezorging Voltooid</button>
            <button class="action-button contact">Contact Klant</button>
        </section>
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
                    <li><a href="privacy.php">Juridicshe verklaring</a></li>
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
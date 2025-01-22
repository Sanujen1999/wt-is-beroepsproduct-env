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

// Verwijder bestelling of markeer als voltooid als de knop is ingedrukt
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    try {
        // Begin een transactie
        $db->beginTransaction();

        // Verwijder de bijbehorende records uit de Pizza_Order_Product tabel
        $sql = "DELETE FROM Pizza_Order_Product WHERE order_id = :order_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->execute();

        // Verwijder de bestelling uit de Pizza_Order tabel
        $sql = "DELETE FROM Pizza_Order WHERE order_id = :order_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->execute();

        // Commit de transactie
        $db->commit();

        echo "<p>Bestelling voltooid voor order $order_id.</p>";
    } catch (PDOException $e) {
        // Rollback de transactie bij een fout
        $db->rollBack();
        echo "<p>Fout bij het verwijderen van de bestelling: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Variabelen voor weergave
$html = "";

// Haal gegevens op uit de database
try {
    $sql = "SELECT order_id, client_name, address FROM Pizza_Order WHERE status = 4"; // Alleen bestellingen met status 4
    $stmt = $db->query($sql);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Genereer HTML voor orders
    foreach ($orders as $order) {
        $html .= "
        <div class='order-item'>
            <p><strong>Bestelling ID:</strong> #" . htmlspecialchars($order['order_id']) . "</p>
            <p><strong>Klantnaam:</strong> " . htmlspecialchars($order['client_name']) . "</p>
            <p><strong>Adres:</strong> " . htmlspecialchars($order['address']) . "</p>
            <form method='POST' action=''>
                <input type='hidden' name='order_id' value='" . htmlspecialchars($order['order_id']) . "'>
                <button type='submit' class='action-button complete'>Bezorging Voltooid</button>
            </form>
            <hr>
        </div>";
    }
} catch (PDOException $e) {
    $html = "<p>Fout bij het ophalen van bestellingen: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
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
        <a href="bestellingoverzicht.php">Bestellingoverzicht</a>
        <a href="detailoverzicht.php">Detailoverzicht</a>
        <a href="login.php">Login</a>
    </div>
    <main class="detail-container">
        <!-- Bestellingsinformatie -->
        <section class="detail-info">
            <h2>Bestellingsinformatie</h2>
            <!-- Dynamisch gegenereerde HTML -->
            <?php echo $html; ?>
        </section>
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

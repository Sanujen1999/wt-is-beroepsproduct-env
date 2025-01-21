<?php
require_once '../applicatie/library/db_connectie.php';
session_start();
$db = maakVerbinding();
$logged_in = isset($_SESSION['username']);
$html = "";

// Statusmapping
$statusMapping = [
    1 => 'ontvangen',
    2 => 'in-behandeling',
    3 => 'gereed',
    4 => 'bezorgd'
];

// Controleer of er een POST-verzoek is om de status bij te werken
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    $personnel_username = $_SESSION['username'];

    // Update de status en personnel_username in de database
    $sql = "UPDATE Pizza_Order SET status = :status, personnel_username = :personnel_username WHERE order_id = :order_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':status', $status, PDO::PARAM_INT);
    $stmt->bindValue(':personnel_username', $personnel_username, PDO::PARAM_STR);
    $stmt->bindValue(':order_id', $order_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<p>Status bijgewerkt van order $order_id.</p>";
    } else {
        echo "<p>Status niet bijgewerkt order $order_id.</p>";
    }
}

// Controleer of er al een sessie actief is
if ($logged_in) {
    $username = $_SESSION['username'];
    $html = "<h1>Welcome {$username}</h1>";
    $html .= '<a href="logout.php">Logout</a>';

    // Haal alle bestellingen op uit de database
    $sql = "SELECT order_id, client_username, client_name, status FROM Pizza_Order";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $bestellingen = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/normalize.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Bestelling Overzicht</title>
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
        <a href="bestellingoverzicht.php">Bestelling Overzicht</a>
        <a href="detailoverzicht.php">DetailOverzicht</a>

    </div>
    <main class="main-container">
        <?php if ($logged_in): ?>
            <?php foreach ($bestellingen as $bestelling): ?>
                <div class="order">
                    <div class="order-info">
                        <p><strong>Bestelling #<?= htmlspecialchars($bestelling['order_id']) ?></strong></p>
                        <p>Klant: <?= htmlspecialchars($bestelling['client_name']) ?></p>
                    </div>
                    <div class="order-status">
                        <form method="POST" action="bestellingoverzicht.php">
                            <input type="hidden" name="order_id" value="<?= htmlspecialchars($bestelling['order_id']) ?>">
                            <label for="status-<?= htmlspecialchars($bestelling['order_id']) ?>">Status:</label>
                            <select id="status-<?= htmlspecialchars($bestelling['order_id']) ?>" name="status" class="status-dropdown">
                                <?php foreach ($statusMapping as $value => $text): ?>
                                    <option value="<?= $value ?>" <?= $bestelling['status'] == $value ? 'selected' : '' ?>><?= $text ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="update-button">Update</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Je moet ingelogd zijn om deze pagina te zien.</p>
        <?php endif; ?>
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
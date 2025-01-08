<?php
session_start();
session_unset(); 
session_destroy();
header("Location: index.php"); // Vervang 'login.php' door de juiste URL exit();
?>

<?php
$host = "localhost";
$dbname = "portfolio_db";
$username = "julien";
$password = "8vcu35jhtk7evz45urxr";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erreur de connexion : " . $e->getMessage());
}
?>

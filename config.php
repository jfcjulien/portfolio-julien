<?php
$host = "localhost";
$dbname = "portfolio_db";
$username = "portfolio_user";
$password = "";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connexion réussie !"; // tu peux décommenter pour tester
} catch (PDOException $e) {
  die("Erreur de connexion : " . $e->getMessage());
}
?>

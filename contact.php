<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  $message = trim($_POST["message"]);

  if (!empty($name) && !empty($email) && !empty($message)) {

    // 1️⃣ Enregistrer dans la base
    $stmt = $pdo->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $message]);

    // 2️⃣ Envoyer l'email
    $to = "julconig297@gmail.com";
    $subject = "📩 Nouveau message de ton portfolio";
    $body = "Nom : $name\nEmail : $email\n\nMessage :\n$message";
    $headers = "From: contact@portfolio.local\r\nReply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
      echo "✅ Merci $name, ton message a bien été envoyé !";
    } else {
      echo "⚠️ Message enregistré, mais l'e-mail n'a pas pu être envoyé.";
    }

  } else {
    echo "⚠️ Merci de remplir tous les champs.";
  }
}
?>

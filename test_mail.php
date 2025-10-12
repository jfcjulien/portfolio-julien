<?php
$to = "julconig297@gmail.com";
$subject = "Test depuis XAMPP";
$message = "Si tu reçois ce mail, ta configuration sendmail + Gmail fonctionne 🎉";
$headers = "From: julconig297@gmail.com\r\n";

if (mail($to, $subject, $message, $headers)) {
  echo "✅ L'e-mail a été envoyé avec succès !";
} else {
  echo "❌ Échec de l'envoi de l'e-mail.";
}
?>

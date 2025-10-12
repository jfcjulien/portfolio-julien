<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Config
$from = "julconig297@gmail.com";
$yourName = "Julien Conigliaro";
$baseDir = __DIR__ . "/docs/"; // Dossier principal

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  $selectedDocs = $_POST["docs"] ?? [];

  if (empty($name) || empty($email) || empty($selectedDocs)) {
    die("⚠️ Merci de remplir tous les champs et de choisir au moins un document.");
  }

  $attachments = [];

  // --- Récupération des fichiers choisis ---
  if (in_array("certifications", $selectedDocs)) {
    $certDir = $baseDir . "certifications/";
    foreach (glob($certDir . "*.pdf") as $file) {
      $attachments[] = $file;
    }
  }

  if (in_array("lettres", $selectedDocs)) {
    $lettreDir = $baseDir . "lettres/";
    foreach (glob($lettreDir . "*.pdf") as $file) {
      $attachments[] = $file;
    }
  }

  // --- Construction du mail ---
  $to = $email;
  $subject = "📎 Documents demandés - $yourName";
  $bodyText = "Bonjour $name,\n\nVous trouverez ci-joint les documents demandés.\n\nCordialement,\n$yourName";

  // Création du message MIME
  $boundary = md5(time());
  $headers = "From: $yourName <$from>\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";

  $message = "--{$boundary}\r\n";
  $message .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
  $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
  $message .= $bodyText . "\r\n";

  // --- Ajout des pièces jointes ---
  foreach ($attachments as $filePath) {
    if (file_exists($filePath)) {
      $fileContent = chunk_split(base64_encode(file_get_contents($filePath)));
      $filename = basename($filePath);

      $message .= "--{$boundary}\r\n";
      $message .= "Content-Type: application/pdf; name=\"{$filename}\"\r\n";
      $message .= "Content-Disposition: attachment; filename=\"{$filename}\"\r\n";
      $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
      $message .= $fileContent . "\r\n";
    }
  }

  $message .= "--{$boundary}--";

  // --- Envoi ---
  if (mail($to, $subject, $message, $headers)) {
    echo "✅ Les documents ont été envoyés à $email.";
  } else {
    echo "❌ Une erreur est survenue lors de l'envoi.";
  }
}
?>

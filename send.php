<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  exit("Método no permitido");
}

$to = "rarf_88@hotmail.com";
$subject = "Nuevo mensaje desde el formulario web";

// Collect fields safely
$data = [];
foreach ($_POST as $key => $value) {
  $cleanKey = htmlspecialchars($key);
  $cleanVal = htmlspecialchars(trim($value));
  if ($cleanVal !== "") {
    $data[] = strtoupper($cleanKey) . ": " . $cleanVal;
  }
}

$message = "Has recibido un nuevo mensaje desde el sitio web:\n\n" . implode("\n", $data);
$headers = "From: Sitio Web <no-reply@" . $_SERVER['SERVER_NAME'] . ">\r\n";
$headers .= "Reply-To: rarf_88@hotmail.com\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8";

if (mail($to, $subject, $message, $headers)) {
  header("Location: index.html?enviado=1#contacto");
  exit;
} else {
  header("Location: index.html?error=1#contacto");
  exit;
}
?>
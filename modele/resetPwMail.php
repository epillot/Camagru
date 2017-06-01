<?php

function resetPwMail($user, $mail, $newpw) {
  $b = "-----=" . md5(rand());
  $header = "From: \"Camagru\"<camagru@noreply.fr>\r\n";
  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Content-Type: multipart/alternative;\r\n" . " boundary=\"$b\"\r\n";

  $subject = "Réinitialisation de votre mot de passe";

  $msg_txt = 'Bonjour ' . $user . ' !
  Votre nouveau de passe est: ' . $newpw . '

   ------------------------------------------
  Ceci est un mail automatique, Merci de ne pas y répondre.';

  $msg_html = "<html><body><h1>Bonjour $user !</h1>
  <br />
  <p>Votre nouveau de passe est: $newpw</p>
  <br />
  <br />
  <p>--------------------------------</p>
  <br />
  <p>Ceci est un mail automatique, Merci de ne pas y répondre.</p></body></html>";

  $msg = "\r\n--$b\r\n";
  $msg .= "Content-Type: text/plain; charset=\"ISO-8859-1\"\r\n";
  $msg .= "Content-Transfer-Encoding: 8bit\r\n";
  $msg .= "\r\n$msg_txt\r\n";
  $msg .= "\r\n--$b\r\n";
  $msg .= "Content-Type: text/html; charset=\"ISO-8859-1\"\r\n";
  $msg .= "Content-Transfer-Encoding: 8bit\r\n";
  $msg .= "\r\n$msg_html\r\n";
  $msg .= "\r\n--$b--\r\n";
  $msg .= "\r\n--$b--\r\n";

  mail($mail, $subject, $msg, $header);
}

?>

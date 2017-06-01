<?php

function sendMailForCom($mail, $autor, $user, $uidph) {
  $b = "-----=" . md5(rand());
  $header = "From: \"Camagru\"<camagru@noreply.fr>\r\n";
  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Content-Type: multipart/alternative;\r\n" . " boundary=\"$b\"\r\n";

  $subject = "Nouveau commentaire sur votre photo";

  $url = "http://localhost:8080/camagru/index.php?p=comment&ph=" . urlencode($uidph);

  $msg_txt = 'Bonjour ' . $autor . ' !
  ' . $user . 'a commenté votre photo !
   Suivez le lien suivant pour le consulter directement.' .
   $url . '


   ------------------------------------------
  Ceci est un mail automatique, Merci de ne pas y répondre.';

  $msg_html = "<html><body><h1>Bonjour $autor !</h1>
  <br />
  <p>$user a commenté votre photo !</p>
  <br />
  <p>Suivez le lien suivant pour le consulter directement.</p>
  <br />
  <a href=$url>Cliquez ici pour consulter le commentaire</a>
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

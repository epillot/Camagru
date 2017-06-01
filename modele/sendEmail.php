<?php

function sendEmail($ps, $mail, $key) {
  $b = "-----=" . md5(rand());
  $header = "From: \"Camagru\"<camagru@noreply.fr>\r\n";
  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Content-Type: multipart/alternative;\r\n" . " boundary=\"$b\"\r\n";

  $url = "http://localhost:8080/camagru/index.php?p=activation&log=" . urlencode($ps) . "&key=" . urlencode($key);

  $subject = "Activation de votre compte";

  $msg_txt = "Bienvenue sur Camagru,
  Pour activer votre compte, veuillez cliquer sur le lien ci dessous
  ou copier/coller dans votre navigateur internet.

  " . $url . "


  --------------------------------
  Ceci est un mail automatique, Merci de ne pas y répondre.";
  //$msg_txt = wordwrap($msg_txt, 70, "\r\n");

  $msg_html = "<html><body><h1>Bienvenue sur Camagru !</h1>
  <br />
  <p>Pour activer votre compte, veuillez cliquer sur le lien ci dessous</p>
  <br />
  <p>ou copier/coller dans votre navigateur internet.</p>
  <br />
  <br />
  <a href=" . "\"$url\"" . ">" . $url . "</a>
  <br />
  <br />
  <br />
  <p>--------------------------------</p>
  <br />
  <p>Ceci est un mail automatique, Merci de ne pas y répondre.</p></body></html>";
  //$msg_html = wordwrap($msg_html, 70, "\r\n");

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

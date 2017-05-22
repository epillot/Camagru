<?php
  $ps = $_GET['log'];
  $key = $_GET['key'];
  $info = $Data->getUserInfo($ps);
  if (!$info)
    echo "<p>Erreur ! Votre compte ne peut être activé...</p>";
  else if ($info['activated'] == 1)
    echo "<p>Votre compte est déjà actif.</p>";
  else
  {
    if ($key == $info['activation_key'])
    {
      $Data->activeUser($ps);
      echo "<p>Votre compte a été activé avec succès.</p>";
    }
  }
?>
<p><a href="index.php">Retour à l'accueil</a><p>

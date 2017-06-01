<?php

if (isset($_POST['uidph']) && isset($_POST['comment']))
{
  session_start();
  require('modele/Data.Class.php');
  $Data = new Data;
  $uidph = $_POST['uidph'];
  $user = $_SESSION['loggued_on_user'];
  $com = $_POST['comment'];
  $Data->addComment($user, $uidph, $com);
  $autor = $Data->getPhotoAutor($uidph);
  if ($autor !== $user)
  {
    $info = $Data->getUserInfo($autor);
    require('modele/sendMailForCom.php');
    sendMailForCom($info['email'], $autor, $user, $uidph);
  }
}

?>

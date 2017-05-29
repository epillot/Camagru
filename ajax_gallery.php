<?php

session_start();
require('modele/Data.Class.php');
$Data = new Data;
$user = $_SESSION['loggued_on_user'];

if (isset($_POST['delete']) && isset($_POST['uidph']))
{
  $photo = basename($_POST['delete']);
  $file = 'private/' . $user . '/' . $photo;
  unlink($file);
  $Data->removePhoto($_POST['uidph']);
}

if (isset($_POST['like_action']) && isset($_POST['uidph']))
{
  $action = $_POST['like_action'];
  $uidph = $_POST['uidph'];
  $Data->updateLike($action, $uidph, $user);
}

?>

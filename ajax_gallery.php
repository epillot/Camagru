<?php

session_start();
require('modele/Data.Class.php');
$Data = new Data;

if (isset($_POST['delete']))
{
  $photo = basename($_POST['delete']);
  $id = explode(".", $photo)[0];
  $user = $_SESSION['loggued_on_user'];
  $file = 'private/' . $user . '/' . $photo;
  unlink($file);
  $uid = $Data->removePhoto($id, $user);
  echo $uid;
}

?>

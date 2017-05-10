<?php

if (isset($_POST['photo']))
{
  $user = $_SESSION['loggued_on_user'];
  $folder = 'private/' . $user;
  $info = $Data->getUserInfo($user);
  date_default_timezone_set('Europe/Paris');
  $date = date('Y-m-d H:i:s');
  $Data->addPhoto($info['id'], $date);
  if (!file_exists($folder))
     mkdir($folder, 0777, true);
  $idph = $info['nb_photo'] + 1;
  $file = $folder . '/' . $idph;
  $file .= '.png';
  file_put_contents($file, $_POST['photo']);
}

require('vue/head.php');
require('vue/salut.php');

?>

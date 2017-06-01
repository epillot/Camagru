<?php

$nbPage = $Data->getNbPage();
if ($nbPage)
{
  if (!isset($_GET['page']))
    $p = 1;
  else
  {
    $p = intval($_GET['page']);
    if ($p > $nbPage)
    $p = $nbPage;
    else if ($p < 1)
    $p = 1;
  }
  $user = $_SESSION['loggued_on_user'];
  $phs = $Data->getGallery(($p - 1) * 6, $user);
  $photos = array();
  foreach ($phs as $ph)
  {
    //$file = 'private/' . $ph['user'] . '/' . $ph['id'] . '.png';
    $login_autor = $Data->getUserById($ph['user'])['login'];
    $src = 'private/' . $login_autor . '/' . $ph['id'] . '.png';
    $photos[] = array('uid' => $ph['uid'], 'user' => $login_autor, 'src' => $src, 'nb_like' => $ph['nb_like'], 'liked' => $ph['liked'], 'nb_com' => $ph['nb_com']);
  }
}
require('page/gallery.php')

?>

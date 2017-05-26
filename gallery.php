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
    $src = 'private/' . $ph['user'] . '/' . $ph['id'] . '.png';
    $photos[] = array('uid' => $ph['uid'], 'user' => $ph['user'], 'src' => $src, 'nb_like' => $ph['nb_like'], 'liked' => $ph['liked'], 'nb_com' => $ph['nb_com']);
  }
}
require('page/gallery.php')

?>

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
  $phs = $Data->getGallery(($p - 1) * 9);
  $photos = array();
  foreach ($phs as $ph)
  {
    $file = 'private/' . $ph['user'] . '/' . $ph['id'] . '.png';
    $photos[] = array('user' => $ph['user'], 'src' => base64_encode(file_get_contents($file)));
  }
}
require('page/gallery.php')

?>

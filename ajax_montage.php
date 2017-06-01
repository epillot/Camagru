<?php

if (isset($_POST['photo']) && isset($_POST['filter']))
{
  $dsty = 150;
  $photo = imagecreatefromstring(base64_decode($_POST['photo']));
  $filter = $_POST['filter'];
  if ($filter == 0)
    $filter = imagecreatefrompng('img/pikachu.png');
  else if ($filter == 1)
    $filter = imagecreatefrompng('img/biere.png');
  else
  {
    $filter = imagecreatefrompng('img/soleil.png');
    $dsty = 0;
  }
  $x = imagesx($filter);
  $y = imagesy($filter);
  imagecopy($photo, $filter, 0, $dsty, 0, 0, $x, $y);
  ob_start();
  imagepng($photo);
  $ret = ob_get_contents();
  ob_end_clean();
  echo base64_encode($ret);
  imagedestroy($photo);
  imagedestroy($filter);

}

?>

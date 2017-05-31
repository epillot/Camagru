<?php

if (isset($_POST['photo']) && isset($_POST['filter']))
{
  $photo = imagecreatefromstring(base64_decode($_POST['photo']));
  $filter = $_POST['filter'];
  if ($filter == 0)
  {
    $filter = imagecreatefrompng('img/pikachu.png');
    $x = imagesx($filter);
    $y = imagesy($filter);
  }
  $filter = imagecreatefrompng('img/' . basename($_POST['filter']));
  //$filter_resize = imagecreatetruecolor(200, 150);
  //$b = imagecolorallocate($filter_resize, 0, 0, 0);
  //imagecolortransparent($filter, 255);
  $x = imagesx($filter);
  $y = imagesy($filter);
  //imagecopyresampled($filter_resize, $filter, 0, 0, 0, 0, 200, 150, $x, $y);
  imagecopy($photo, $filter, 0, 150, 0, 0, $x, $y);
  //imagedestroy($filter);
  ob_start();
  imagepng($photo);
  $ret = ob_get_contents();
  ob_end_clean();
  echo base64_encode($ret);
  imagedestroy($photo);
  imagedestroy($filter);

}

?>

<?php

if (isset($_POST['photo']) && isset($_POST['filter']))
{
  $photo = $_POST['photo'];
  $filter = imagecreatefrompng('img/' . basename($_POST['filter']));
  imagecopy($photo, $filter, 0, 0, 0, 0, 50, 50);
  echo $photo;
}

?>

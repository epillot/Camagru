<?php

if (isset($_GET['ph']))
{
  if (ctype_digit($_GET['ph']) && ($photo = $Data->getPhoto($_GET['ph'])) !== false)
  {
    echo $photo['id'];
    echo "<br />";
    echo $photo['nb_com'];
  }
  else
    echo "<p>Cette photo n'existe pas...</p>";

}
else
  echo "<p>Aucune photo séléctionnée...</p>";

?>

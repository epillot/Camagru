<?php

  if ($nbPage)
  {
    echo "<div id='link' align='center'>";
    for ($i = 1; $i <= $nbPage; $i++)
    {
      if ($i == $p)
        echo "[ $i ]";
      else
        echo "<a href='index.php?p=gallery&page=$i'>Page $i</a>";
      echo " ";
    }
    echo "</div>";
    foreach ($photos as $photo)
    {
      $src = 'data:image/png;base64,';
      $src .= $photo['src'];

      echo "<div class='gallery'>";
      echo "<img src=$src></img>";
      if ($_SESSION['loggued_on_user'] === $photo['user'])
      {
        $usr = 'vous';
        echo "<div class='delete'>";
        echo "<img src='img/delete.ico' onclick='delete();' alt='supprimer' title='supprimer'></img>";
        echo "</div>";
      }
      else
        $usr = $photo['user'];
      echo "<p align='center'>Ajouté par ";
      echo $usr;
      echo "</p>";
      echo "</div>";
    }
  }
  else
    echo "<p>La gallerie est vide...</p>"

?>
<script type="text/javascript" src="js/delete.js"></script>

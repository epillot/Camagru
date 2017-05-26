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
      $src = $photo['src'];
      $nb_like = $photo['nb_like'];
      $id = $photo['uid'];
      $nb_com = $photo['nb_com'];
      echo "<div class='gallery'>";
      echo "<img id=$id src=$src></img>";
      if ($_SESSION['loggued_on_user'] === $photo['user'])
      {
        $usr = 'vous';
        echo "<div class='delete'>";
        echo "<img src='img/delete.ico' onclick='deletePhoto(this);' alt='supprimer' title='supprimer'></img>";
        echo "</div>";
      }
      else
        $usr = $photo['user'];
      echo "<div class='photo_setting' style='padding: 5px 10px'>";
      echo "<p style='margin: 0'>Ajouté par ";
      echo $usr;
      echo "</p>";
      echo "<p style='margin: 0'>aimée $nb_like fois</p>";
      if (isset($_SESSION['loggued_on_user']) && $Data->userExists($_SESSION['loggued_on_user']))
      {
        echo "<div onclick='likeOrUnlike(this)' class='like'>";
        if ($photo['liked'])
          echo "<img class='liked' src='img/active_like.png'; alt='unlike' title='unlike'></img>";
        else
          echo "<img class='notlike' src='img/like.png' alt='like' title='like'></img>";
        echo "</div>";
      }
      echo "</div>";
      echo "<a href=index.php?p=comment&ph=$id><p style='margin: 0' align='center'>$nb_com commentaire(s)</p></a>";
      echo "</div>";
    }
  }
  else
    echo "<p>La gallerie est vide...</p>"

?>
<script type="text/javascript" src="js/gallery.js"></script>

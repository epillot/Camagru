<?php

if (isset($_GET['ph']))
{
  if (ctype_digit($_GET['ph']) && ($photo = $Data->getPhoto($_GET['ph'])) !== false)
  {
    $user = $_SESSION['loggued_on_user'];
    $id = $_GET['ph'];
    $comments = $Data->getComments($id);
    $login_autor = $Data->getUserById($photo['id_user']);
    $login_autor = $login_autor['login'];
    $src = 'private/' . $login_autor . '/' . $photo['id'] . '.png';
    require('page/comment.php');
  }
  else
    echo "<p>Cette photo n'existe pas...</p>";

}
else
  echo "<p>Aucune photo séléctionnée...</p>";

?>

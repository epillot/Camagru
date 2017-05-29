<div id='comment_page'>
  <img src=<?= $src ?> id=<?= $id ?>></img>
  <div id='comment'>
  <?php
    if (isset($_SESSION['loggued_on_user']) && $Data->userExists($_SESSION['loggued_on_user']))
    {
      echo "<div id='write_com'>";
      echo "<p align='center'>Ecrire un commentaire:</p>";
      echo "<textarea cols='60' rows='4' maxlength='250'></textarea>";
      echo "<button id='send_com' onclick='sendComment();'>Ok</button>";
      echo "</div>";
    }
  ?>
    <div id='com_content'>
    <?php
      if ($photo['nb_com'])
      {
        foreach ($comments as $comment)
        {
          $autor = $comment['user'];
          if ($user == $autor)
            $autor = 'vous';
          $content = $comment['content'];
          echo "<p>$autor: $content</p>";
        }
      }
      else
        echo "<p id='no_comment' align='center'>Cette photo n'a pas encore été commentée.</p>";
    ?>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/comment.js"></script>

<body>
  <?php require('header.php') ?>
  <div id="create">
    <form method="post" action="create.php">
      <p>Pseudo</p>
      <input type="text" name="pseudo" minlength="3" maxlength="20" required="required"/>
      <p>Mot de passe</p>
      <input type="password" name="pw" minlength="6" required="required"/>
      <p>Adresse email</p>
      <input type="email" name="mail" maxlength="320" required="required" size="30"/>
      <p><input type="submit" name="submit" value="Create"/></p>
    </form>
  </div>
</body>
</html>
<body>
  <?php require('header.php') ?>
  <div class="page">
    <?php //require('sidebar.php') ?>
    <div>
      <form id="login" method="post" action="index.php?page=log">
        <p>Pseudo</p>
        <input type="text" name="pseudo" minlength="3" maxlength="20" required="required"/>
        <p>Mot de passe</p>
        <input type="password" name="pw" minlength="6" required="required"/>
        <p><input type="submit" name="submit" value="OK"/></p>
        <?php if (isset($err)) {echo $err;} ?>
      </form>
    </div>
  </div>
</body>
</html>

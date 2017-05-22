<div id="create">
  <form method="post" action="index.php?p=create">
    <p>Pseudo</p>
    <input type="text" name="pseudo" minlength="3" maxlength="20" required="required"/>
    <p>Mot de passe</p>
	  <input id="pw1" type="password" name="pw" minlength="6" maxlength="30" required="required"/>
    <p>Confirmer mot de passe</p>
    <input id= "pw2" type="password" name="repw" minlength="6" maxlength="30" required="required"/>
    <p>Adresse email</p>
    <input type="email" name="mail" maxlength="320" required="required" size="30"/>
    <p><input type="submit" name="submit" value="OK"/></p>
    <?php if (isset($err)) {echo $err;} ?>
  </form>
</div>

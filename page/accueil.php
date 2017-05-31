<div id="accueil_page">
<div>
<h2 align='center'>Se connecter</h2>
<div id='login'>
  <form id="log_form" method="post" action=".">
    <p>Pseudo</p>
    <input type="text" name="login" minlength="3" maxlength="20" required="required"/>
    <p>Mot de passe</p>
    <input type="password" name="log_pw" minlength="6" required="required"/>
    <p><input type="submit" name="log" value="OK"/></p>
  </form>
  <?php if (isset($errlog)) {echo $errlog;} ?>
</div>
</div>
<div>
<h2 align='center'>Créer un compte</h2>
<div id="create">
  <form id="create_form"  method="post">
    <p>Pseudo</p>
    <input id='log' class='input' type="text" name="pseudo" minlength="3" maxlength="20" required="required"/>
    <p>Mot de passe</p>
	  <input id="pw1" class='input' type="password" name="pw" minlength="6" maxlength="30" required="required"/>
    <p>Confirmer mot de passe</p>
    <input id="pw2" class='input' type="password" name="repw" minlength="6" maxlength="30" required="required"/>
    <p>Adresse email</p>
    <input id="mail" class='input' type="email" name="mail" maxlength="320" required="required"/>
    <p><input type="submit" value="OK" name="create"/></p>
  </form>
</div>
</div>
</div>
<script type="text/javascript" src="js/accueil.js"></script>

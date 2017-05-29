<!-- <div id="presentation">
	<p>Bienvenue sur Camagru,
	<br />
	application pour creation, publication et consultation de photo-montage en ligne.</p>
	<p></p>
</div>
<div id="accueil">
	<p><a href="index.php?p=login">Se connecter</a></p>
	<br />
	<p>ou</p>
	<br />
	<p><a href="index.php?p=create">Créer un compte</a></p>
</div> -->
<div id="accueil_page">
<div>
<h2 align='center'>Se connecter</h2>
<div id='login'>
  <form method="post" action=".">
    <p>Pseudo</p>
    <input type="text" name="pseudo" minlength="3" maxlength="20" required="required"/>
    <p>Mot de passe</p>
    <input type="password" name="pw" minlength="6" required="required"/>
    <p><input type="submit" name="login" value="OK"/></p>
  </form>
</div>
<?php if (isset($errlog)) {echo $errlog;} ?>
</div>
<div>
<h2 align='center'>Créer un compte</h2>
<div id="create">
  <form method="post" action=".">
    <p>Pseudo</p>
    <input type="text" name="pseudo" minlength="3" maxlength="20" required="required"/>
    <p>Mot de passe</p>
	  <input id="pw1" type="password" name="pw" minlength="6" maxlength="30" required="required"/>
    <p>Confirmer mot de passe</p>
    <input id= "pw2" type="password" name="repw" minlength="6" maxlength="30" required="required"/>
    <p>Adresse email</p>
    <input type="email" name="mail" maxlength="320" required="required"/>
    <p><input type="submit" name="create" value="OK"/></p>
  </form>
</div>
<?php if (isset($errcreate)) {echo $errcreate;} ?>
</div>
</div>

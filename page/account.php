<div id="account_page">
<div id="account_container">
<div id="compte_info">
  <h2>Mon compte</h2>
  <div class="section">
    <div class="account_title">
      <h3>Pseudo</h3>
      <button onclick="modifPs();">modifier</button>
    </div>
      <p id="p_user"><?= htmlentities($_SESSION['loggued_on_user']); ?></p>
  </div>
  <div class="section">
    <div class="account_title">
      <h3>Mot de passe</h3>
      <button onclick="modifPw();">modifier</button>
    </div>
    <p>***</p>
  </div>
  <div class="section">
    <div class="account_title">
      <h3>Adresse email</h3>
      <button onclick="modifMail();">modifier</button>
    </div>
    <p id="p_mail"><?= htmlentities($info['email']); ?></p>
  </div>
  <br />
  <p style="font-style: italic">Membre depuis le <?= $info['date_de_creation']; ?></p>
</div>
<div id='log_div' style="display: none">
  <form id='log_form' action="post">
    <p>Nouveau Pseudo</p>
    <input class='input' type="text" name="login" minlength="3" maxlength="20" required="required"/>
    <p>Mot de passe</p>
    <input class='input' type="password" name="pw" minlength="6" maxlength="30" required="required"/>
    <p><input type="submit" value="OK"/></p>
  </form>
</div>
<div id='pw_div' style="display: none">
  <form id='pw_form'>
    <p>Mot de passe actuel</p>
	  <input id="pw" class='input' type="password" name="oldpw" minlength="6" maxlength="30" required="required"/>
    <p>Nouveau mot de passe</p>
	  <input id="pw1" class='input' type="password" name="newpw" minlength="6" maxlength="30" required="required"/>
    <p>Confirmer mot de passe</p>
    <input id="pw2" class='input' type="password" name="renewpw" minlength="6" maxlength="30" required="required"/>
    <p><input type="submit" value="OK"/></p>
  </form>
</div>
<div id='mail_div' style="display: none">
  <form id='mail_form'>
    <p>Nouvelle adresse email</p>
    <input id="mail" class='input' type="email" name="mail" maxlength="320" required="required"/>
    <p>Mot de passe</p>
	  <input id="pw_mail" class='input' type="password" name="pw_mail" minlength="6" maxlength="30" required="required"/>
    <p><input type="submit" value="OK"/></p>
  </form>
</div>
</div>
</div>
<script type="text/javascript" src="js/account.js"></script>

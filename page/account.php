<div id="account_page">
<div id="compte_info">
  <h2>Mon compte</h2>
  <div class="section">
    <div class="account_title">
      <h3>Pseudo</h3>
      <button onclick="modifPs();">modifier</button>
    </div>
      <p><?= htmlentities($_SESSION['loggued_on_user']); ?></p>
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
    <p><?= htmlentities($info['email']); ?></p>
  </div>
  <br />
  <p>Membre depuis le <?= $info['date_de_creation']; ?></p>
</div>
<?php if (isset($ret)) {echo "<div>$ret</div>";}?>
</div>
<script type="text/javascript" src="js/account.js"></script>

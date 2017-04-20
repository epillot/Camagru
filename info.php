<?php require('vue/head.php'); ?>
<body>
<?php

require('vue/header.php');
if ($_GET['page'] == 'success')
	echo "<p>Votre compte a été créé avec succès !</p>";
else if ($_GET['page'] == 'usexists')
	echo "<p>Le login que vous avez choisi n'est pas disponible.</p>";
else if ($_GET['page'] == 'emexists')
	echo "<p>Votre adresse email à déjà été utilisée.</p>";
else if ($_GET['page'] == 'winfo')
	echo "<p>Les informations que vous avez saisies sont incorrects.</p>";
else if ($_GET['page'] == 'wauth')
	echo "<p>Votre identifiant ou votre mot de passe est incorrect.</p>"
?>
	<p><a href="index.php">Retour à l'accueil</a><p>
</body>
</html>

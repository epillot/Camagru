<?php

if ($_POST['submit'] == 'OK')
{
	date_default_timezone_set('Europe/Paris');
	$ps = $_POST['pseudo'];
	$pw = $_POST['pw'];
	$pw2 = $_POST['repw'];
	$mail = $_POST['mail'];
	$date = date('Y-m-d H:i:s');
	if ($pw !== $pw2)
		$err = "<p id='err'>Les deux mots de passe saisis ne sont pas identiques.</p>";
	else if (strlen($ps) < 3 || strlen($ps) > 20)
		$err = "<p id='err'>Le pseudo doit contenir entre 3 et 20 caractères.</p>";
	else if (strlen($pw) < 6 || strlen($pw) > 30)
		$err = "<p id='err'>Le mot de passe doit contenir entre 6 et 20 caractères.</p>";
	else if ($Data->userExists($ps))
		$err = "<p id='err'>Le login que vous avez choisi n'est pas disponible.</p>";
	else if ($Data->emailExists($mail))
		$err = "<p id='err'>Votre adresse email à déjà été utilisée.</p>";
	else
	{
		$pw = hash('whirlpool', $_POST['pw']);
		$Data->insertUser($ps, $pw, $mail, $date);
		header('Location: info.php');
	}
}

require('vue/head.php');
require('vue/create.php');

?>

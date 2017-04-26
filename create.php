<?php

if ($_POST['submit'] == 'OK')
{
	date_default_timezone_set('Europe/Paris');
	$ps = $_POST['pseudo'];
	$pw = $_POST['pw'];
	$mail = $_POST['mail'];
	$date = date('Y-m-d H:i:s');
	if (strlen($ps) < 3 || strlen($ps) > 20)
		$err = "Le pseudo doit contenir entre 3 et 20 caractères";
	else if (strlen($pw) < 6 || strlen($pw) > 30)
		$err = "<p>Le mot de passe doit contenir entre 6 et 20 caractères</p>";
	else if ($Data->userExists($ps))
		$err = "<p>Le login que vous avez choisi n'est pas disponible</p>";
	else {
		$pw = hash('whirlpool', $_POST['pw']);
		$ret = $Data->insertUser($ps, $pw, $mail, $date);
		if ($ret === Data::SUCCESS_USER_INSERT)
			header('Location: info.php?page=success');
		else if ($ret === Data::USER_EXISTS)
			header('Location: info.php?page=usexists');
		else if ($ret === Data::EMAIL_EXISTS)
			header('Location: info.php?page=emexists');
	}
}

require('vue/head.php');
require('vue/create.php');

?>

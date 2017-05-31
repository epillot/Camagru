<?php

if ($_POST['log'] == 'OK')
{
	$ps = $_POST['login'];
	$pw = hash('whirlpool', $_POST['log_pw']);
	if ($Data->auth($ps, $pw) === false)
		$errlog = "<p id='err'>Pseudo ou mot de passe incorrect.</p>";
	else
	{
		$info = $Data->getUserInfo($ps);
		if ($info['activated'] == 1)
		{
			$_SESSION['loggued_on_user'] = $ps;
			header('Location: index.php');
		}
		else
			$errlog = "<p id='err'>Votre compte n'a pas été activé.</p>";
	}
}

require('page/accueil.php');

?>

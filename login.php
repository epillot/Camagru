<?php

if ($_POST['submit'] == 'OK')
{
	$ps = $_POST['pseudo'];
	$pw = hash('whirlpool', $_POST['pw']);
	if ($Data->auth($ps, $pw) === false)
		$err = "<p id='err'>Pseudo ou mot de passe incorrect.</p>";
	else
	{
		$_SESSION['loggued_on_user'] = $ps;
		header('Location: index.php');
	}
}

require('vue/head.php');
require('vue/login.php');

?>

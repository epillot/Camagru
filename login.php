<?php

if ($_POST['submit'] == 'OK')
{
	$ps = $_POST['pseudo'];
	$pw = hash('whirlpool', $_POST['pw']);
	if ($Data->auth($ps, $pw) === false)
		$err = "<p id='err'>Pseudo ou mot de passe incorrect.</p>";
	else
	{
		$info = $Data->getUserInfo($ps);
		if ($info['activated'] == 1)
		{
			$_SESSION['loggued_on_user'] = $ps;
			header('Location: index.php');
		}
		else
			header('Location: index.php?p=info&i=notactive');
	}
}

require('page/login.php');

?>

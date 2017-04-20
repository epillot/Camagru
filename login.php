<?php

if ($_POST['submit'] == 'OK')
{
	$ps = $_POST['pseudo'];
	$pw = hash('whirlpool', $_POST['pw']);
	$ret = $GlobalData->auth($ps, $pw);
	if ($ret === false)
		header('Location: info.php?page=wauth');
	else
	{
		$_SESSION['loggued_on_user'] = $ps;
		header('Location: index.php');
	}
}

require('vue/head.php');
require('vue/login.php');

?>

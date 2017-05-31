<?php

session_start();
require('modele/Data.Class.php');
$Data = new Data;
ob_start();
if (isset($_SESSION['loggued_on_user']) && $Data->userExists($_SESSION['loggued_on_user']))
{
	if (!isset($_GET['p']))
		$_GET['p'] = 'montage';
	if (!file_exists($_GET['p'] . '.php'))
		$_GET['p'] = '404';
	require($_GET['p'] . '.php');
}
else
{
	if (!isset($_GET['p']))
		$_GET['p'] = 'accueil';
	else if ($_GET['p'] == 'montage' || $_GET['p'] == 'account')
		$_GET['p'] = 'forbidden';
	if (!file_exists($_GET['p'] . '.php'))
		$_GET['p'] = '404';
	require($_GET['p'] . '.php');
}
$page = ob_get_contents();
ob_end_clean();
$style = "<link rel='stylesheet' href='css/" . $_GET['p'] . ".css'>";
require('template.php');

?>

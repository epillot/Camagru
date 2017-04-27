<?php

session_start();
require('modele/Data.Class.php');
$Data = new Data;

if (isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] !== "")
{
	if ($_GET['page'] == 'account')
	{
		require('account.php');
	}
	else
	{
		require('salut.php');
	}
}
else
{
	if ($_GET['page'] == 'log')
	{
		require('login.php');
	}
	else if ($_GET['page'] == 'create')
	{
		require('create.php');
	}
	else if ($_GET['page'] == 'act')
	{
		require('activation.php');
	}
	else
	{
		require('accueil.php');
	}
}

?>

<?php

session_start();
require('config/setup.php');
if ($_GET['page'] == 'log')
{
  require('login.php');
}
else if ($_GET['page'] == 'create')
{
  require('create.php');
}
else
{
  require('accueil.php');
}

?>

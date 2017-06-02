<?php
$ps = $_SESSION['loggued_on_user'];
$info = $Data->getUserInfo($ps);

require('page/account.php');

?>

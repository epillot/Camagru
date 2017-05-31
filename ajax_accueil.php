<?php

if (isset($_POST['pseudo']) && isset($_POST['pw']) && isset($_POST['repw']) && isset($_POST['mail']))
{
  require('modele/Data.Class.php');
  $Data = new Data;
	date_default_timezone_set('Europe/Paris');
	$ps = $_POST['pseudo'];
	$pw = $_POST['pw'];
	$pw2 = $_POST['repw'];
	$mail = $_POST['mail'];
	$date = date('Y-m-d H:i:s');
	if ($pw !== $pw2)
    echo json_encode(array('success' => false, 'err' => 'not same pw'));
	else if (strlen($ps) < 3 || strlen($ps) > 20)
    echo json_encode(array('success' => false, 'err' => 'wg ps len'));
	else if (strlen($pw) < 6 || strlen($pw) > 30 || !preg_match('/[a-zA-Z]/', $pw) || !preg_match('/[1-9]/', $pw))
    echo json_encode(array('success' => false, 'err' => 'wg pw'));
	else if ($Data->userExists($ps))
    echo json_encode(array('success' => false, 'err' => 'user exists'));
	else if ($Data->emailExists($mail))
    echo json_encode(array('success' => false, 'err' => 'mail exists'));
	else
	{
	 	$key = md5(rand());
	 	$pw = hash('whirlpool', $_POST['pw']);
		$Data->insertUser($ps, $pw, $mail, $date, $key);
		require('modele/sendEmail.php');
		sendEmail($ps, $mail, $key);
		echo json_encode(array('success' => true));
	}
}

?>

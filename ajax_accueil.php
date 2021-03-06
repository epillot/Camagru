<?php

require('modele/Data.Class.php');
$Data = new Data;

if (isset($_POST['pseudo']) && isset($_POST['pw']) && isset($_POST['repw']) && isset($_POST['mail']))
{
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
  else if (strlen($mail) > 320 || !preg_match('/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}$/', $mail))
    echo json_encode(array('success' => false, 'err' => 'invalid mail'));
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

if (isset($_POST['login']) && isset($_POST['log_pw']))
{
	$ps = $_POST['login'];
	$pw = hash('whirlpool', $_POST['log_pw']);
	if ($Data->auth($ps, $pw) === false)
		echo json_encode(array('success' => false, 'err' => 'auth'));
	else
	{
		$info = $Data->getUserInfo($ps);
		if ($info['activated'] == 1)
		{
			session_start();
			$_SESSION['loggued_on_user'] = $ps;
			echo json_encode(array('success' => true));
		}
		else
			echo json_encode(array('success' => false, 'err' => 'not active'));
	}
}

if (isset($_POST['mail_reset_pw']))
{
  $mail = $_POST['mail_reset_pw'];
  if (!$Data->emailExists($mail))
    echo json_encode(array('success' => false));
  else
  {
    $user = $Data->getUserByMail($mail)['login'];
    $newpw = substr(md5(rand()), 0, 8);
    $Data->updatePw($user, hash('whirlpool', $newpw));
    require('modele/resetPwMail.php');
    resetPwMail($user, $mail, $newpw);
    echo json_encode(array('success' => true));
  }
}

?>

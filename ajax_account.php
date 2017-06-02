<?php

require('modele/Data.Class.php');
$Data = new Data;
session_start();
$user = $_SESSION['loggued_on_user'];

if (isset($_POST['login']) && isset($_POST['pw']))
{
  $pw = $_POST['pw'];
  $newps = $_POST['login'];
  if (strlen($newps) < 3 || strlen($newps) > 20)
    echo json_encode(array('success' => false, 'err' => 'wg ps len'));
  else if ($Data->auth($user, hash('whirlpool', $pw)) === false)
    echo json_encode(array('success' => false, 'err' => 'auth'));
  else if ($Data->userExists($newps))
    echo json_encode(array('success' => false, 'err' => 'user exists'));
  else
  {
    $folder = 'private/' . $user;
    if (file_exists($folder))
    {
      $newfolder = 'private/' . $newps;
      rename($folder, $newfolder);
    }
    $Data->updatePs($user, $newps);
    $_SESSION['loggued_on_user'] = $newps;
    echo json_encode(array('success' => true, 'log' => $newps));
  }
}

if (isset($_POST['oldpw']) && isset($_POST['newpw']) && isset($_POST['renewpw']))
{
  $pw = $_POST['oldpw'];
  $newpw = $_POST['newpw'];
  $renewpw = $_POST['renewpw'];
  if ($newpw !== $renewpw)
    echo json_encode(array('success' => false, 'err' => 'not same pw'));
  else if (strlen($newpw) < 6 || strlen($newpw) > 30 || !preg_match('/[a-zA-Z]/', $newpw) || !preg_match('/[1-9]/', $newpw))
    echo json_encode(array('success' => false, 'err' => 'invalid pw'));
  else if ($Data->auth($user, hash('whirlpool', $pw)) === false)
    echo json_encode(array('success' => false, 'err' => 'auth'));
  else
  {
    $Data->updatePw($user, hash('whirlpool', $newpw));
    echo json_encode(array('success' => true));
  }
}

if (isset($_POST['mail']) && isset($_POST['pw_mail']))
{
  $pw = $_POST['pw_mail'];
  $mail = $_POST['mail'];
  if (strlen($mail) > 320 || !preg_match('/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}$/', $mail))
    echo json_encode(array('success' => false, 'err' => 'invalid mail'));
  else if ($Data->auth($user, hash('whirlpool', $pw)) === false)
    echo json_encode(array('success' => false, 'err' => 'auth'));
  else if ($Data->emailExists($mail))
    echo json_encode(array('success' => false, 'err' => 'mail exists'));
  else
  {
    $Data->updateMail($user, $mail);
    echo json_encode(array('success' => true, 'mail' => $mail));
  }
}

?>

<?php
$ps = $_SESSION['loggued_on_user'];
$info = $Data->getUserInfo($ps);
if ($_POST['modifps'] == "Ok")
{
  $pw = $_POST['pw'];
  $newps = $_POST['newps'];
  if (strlen($pw) < 6 || strlen($pw) > 30)
		$ret = "<p id='err'>Le mot de passe doit contenir entre 6 et 20 caractères.</p>";
  else if (strlen($newps) < 3 || strlen($newps) > 20)
  	$ret = "<p id='err'>Le pseudo doit contenir entre 3 et 20 caractères.</p>";
  else if ($Data->auth($ps, hash('whirlpool', $pw)) === false)
    $ret = "<p id='err'>Mot de passe incorrect.</p>";
  else if ($Data->userExists($newps))
    $ret = "<p id='err'>Le login que vous avez choisi n'est pas disponible.</p>";
  else
  {
    $folder = 'private/' . $ps;
    if (file_exists($folder))
    {
      $newfolder = 'private/' . $newps;
      rename($folder, $newfolder);
    }
    $Data->updatePs($ps, $newps);
    $_SESSION['loggued_on_user'] = $newps;
    $ret = "<p>Votre pseudo à été modifié avec succès</p>";
  }
}
else if ($_POST['modifpw'] == "Ok")
{
  $pw = $_POST['oldpw'];
  $newpw = $_POST['newpw'];
  $renewpw = $_POST['renewpw'];
  if ($newpw !== $renewpw)
    $ret = "<p id='err'>Les deux mots de passe saisis ne sont pas identiques.</p>";
  else if ($Data->auth($ps, hash('whirlpool', $pw)) === false)
    $ret = "<p id='err'>Mot de passe incorrect.</p>";
  else if (strlen($newpw) < 6 || strlen($newpw) > 30 || !preg_match('/[a-zA-Z]/', $newpw) || !preg_match('/[1-9]/', $newpw))
    $ret = "<p id='err'>Le mot de passe doit contenir entre 6 et 30 caractères et comporter au moins un chiffre et une lettre.</p>";
  else
  {
    $Data->updatePw($ps, hash('whirlpool', $newpw));
    $ret = "<p>Votre mot de passe à été modifié avec succès</p>";
  }
}
else if ($_POST['modifmail'] == "Ok")
{
    $pw = $_POST['pw'];
    $mail = $_POST['mail'];
    if (strlen($mail) > 320 || !preg_match('/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}$/', $mail))
      $ret = "<p id='err'>Votre adresse email n'est pas valide</p>";
    else if ($Data->auth($ps, hash('whirlpool', $pw)) === false)
      $ret = "<p id='err'>Mot de passe incorrect.</p>";
    else if ($Data->emailExists($mail))
      $ret = "<p id='err'>Cette adresse email à déjà été utilisée.</p>";
    else
    {
      $Data->updateMail($ps, $mail);
      $ret = "<p>Votre adresse email à été modifié avec succès</p>";
    }

}

require('page/account.php');

?>

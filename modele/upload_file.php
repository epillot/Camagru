<?php

function upload_file() {
  if ($_FILES['upload']['error'] > 0)
    return (array('success' => false, 'error' => 'Erreur lors du transfert'));
  if ($_FILES['upload']['size'] > 2000000)
    return (array('success' => false, 'error' => 'Le fichier est trop gros'));
  $valid = array('jpg' , 'jpeg' , 'gif' , 'png');
  $ext = strtolower(substr(strrchr($_FILES['upload']['name'], '.'), 1));
  if (!in_array($ext, $valid))
    return (array('success' => false, 'error' => 'Extension incorrecte'));
  $img = base64_encode(file_get_contents($_FILES['upload']['tmp_name']));
  return (array('success' => true, 'ext' => $ext, 'file' => $img));
}

?>

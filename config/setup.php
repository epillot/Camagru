<?php

try {
	$db = new PDO('mysql:host=localhost', 'root', 'root');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
	die('Error: ' . $e->getMessage());
}

$db->exec('CREATE DATABASE IF NOT EXISTS db_camagru;');

require('database.php');

try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
	die('Error: ' . $e->getMessage());
}

$q = "CREATE TABLE IF NOT EXISTS user(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	login VARCHAR(20) NOT NULL,
	passwd VARCHAR(128) NOT NULL,
	email VARCHAR(320) NOT NULL,
	date_de_creation DATETIME NOT NULL,
	activation_key VARCHAR(32) NOT NULL,
	activated SMALLINT DEFAULT 0,
	nb_photo INT NOT NULL DEFAULT 0);";
$db->exec($q);

$q = "CREATE TABLE IF NOT EXISTS photo(
	id INT NOT NULL,
	user VARCHAR(20) NOT NULL,
	date_ajout DATETIME NOT NULL);";
$db->exec($q);

?>

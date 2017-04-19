<?php

require('database.php');

try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
	die('Error: ' . $e->getMessage());
}

$db->exec('CREATE TABLE IF NOT EXISTS user(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, login VARCHAR(20) NOT NULL, passwd VARCHAR(128) NOT NULL, email VARCHAR(320) NOT NULL);');

?>
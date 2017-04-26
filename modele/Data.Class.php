<?php

Class Data {

	public $db;
	CONST SUCCESS_USER_INSERT = 0;
	CONST USER_EXISTS = 1;
	CONST EMAIL_EXISTS = 2;

	public function __construct() {
		require('config/database.php');
		try {
			$this->db = new PDO($DB_DSN, $DB_USER, $DB_PASSWD);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e) {
			die('Error: ' . $e->getMessage());
		}
	}

	public function userExists($ps) {
		$ret = false;
		$req = $this->db->prepare('SELECT login FROM user WHERE login = ?');
		$req->execute(array($ps));
		if ($req->fetch() !== false)
			$ret = true;
		$req->closeCursor();
		return $ret;
	}

	private function _emailExists($mail) {
		$ret = false;
		$req = $this->db->prepare('SELECT email FROM user WHERE email = ?');
		$req->execute(array($mail));
		if ($req->fetch() !== false)
			$ret = true;
		$req->closeCursor();
		return $ret;
	}

	public function insertUser($ps, $pw, $mail, $date) {
		if ($this->_emailExists($mail))
			return self::EMAIL_EXISTS;
		$req = $this->db->prepare('INSERT INTO user(login, passwd, email, date_de_creation) VALUES(:login, :pw, :email, :date)');
		$req->execute(array('login' => $ps, 'pw' => $pw, 'email' => $mail, 'date' => $date));
		return self::SUCCESS_USER_INSERT;
	}

	public function auth($ps, $pw) {
		$req = $this->db->prepare('SELECT login FROM user WHERE login = :login AND passwd = :pw');
		$req->execute(array('login' => $ps, 'pw' => $pw));
		$ret = $req->fetch();
		$req->closeCursor();
		return $ret;
	}

}

?>

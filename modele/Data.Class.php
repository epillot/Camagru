<?php

Class Data {

	public $db;

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

	public function emailExists($mail) {
		$ret = false;
		$req = $this->db->prepare('SELECT email FROM user WHERE email = ?');
		$req->execute(array($mail));
		if ($req->fetch() !== false)
			$ret = true;
		$req->closeCursor();
		return $ret;
	}

	public function getUserInfo($ps) {
		$req = $this->db->prepare('SELECT id, email, date_de_creation, activation_key, activated, nb_photo FROM user WHERE login = ?');
		$req->execute(array($ps));
		$info = $req->fetch();
		$req->closeCursor();
		return ($info);
	}

	public function insertUser($ps, $pw, $mail, $date, $key) {
		$req = $this->db->prepare('INSERT INTO user(login, passwd, email, date_de_creation, activation_key) VALUES(:login, :pw, :email, :date, :key)');
		$req->execute(array('login' => $ps, 'pw' => $pw, 'email' => $mail, 'date' => $date, 'key' => $key));
	}

	public function activeUser($ps) {
		$req = $this->db->prepare('UPDATE user SET activated = 1 WHERE login = ?');
		$req->execute(array($ps));
	}

	public function auth($ps, $pw) {
		$req = $this->db->prepare('SELECT login FROM user WHERE login = :login AND passwd = :pw');
		$req->execute(array('login' => $ps, 'pw' => $pw));
		$ret = $req->fetch();
		$req->closeCursor();
		return $ret;
	}

	public function updatePs($ps, $newps) {
		$req = $this->db->prepare('UPDATE user SET login = ? WHERE login = ?');
		$req->execute(array($newps, $ps));
	}

	public function updatePw($ps, $newpw) {
		$req = $this->db->prepare('UPDATE user SET passwd = ? WHERE login = ?');
		$req->execute(array($newpw, $ps));
	}

	public function updateMail($ps, $mail) {
		$req = $this->db->prepare('UPDATE user SET email = ? WHERE login = ?');
		$req->execute(array($mail, $ps));
	}

	public function addPhoto($user, $date) {
		$info = $this->getUserInfo($user);
		$req = $this->db->prepare('INSERT INTO photo(id, user, date_ajout) VALUES(?, ?, ?)');
		$req->execute(array($info['nb_photo'], $user, $date));

		$req = $this->db->prepare('UPDATE user SET nb_photo = nb_photo + 1 WHERE login = ?');
		$req->execute(array($user));
	}

	public function getNbPage() {
		$req = $this->db->query('SELECT COUNT(*) AS total FROM photo');
		$ret = $req->fetch();
		$total = $ret['total'];
		$req->closeCursor();
		return (ceil($total / 9));
	}

	public function getGallery($p) {
		$req = $this->db->prepare("SELECT id, user FROM photo ORDER BY date_ajout DESC LIMIT $p, 9");
		$req->execute();
		$ret = array();
		while ($photo = $req->fetch())
		{
			$ret[] = array('id' => $photo['id'], 'user' => $photo['user']);
		}
		$req->closeCursor();
		return $ret;
	}

	public function removePhoto($id, $user) {
		$req = $this->db->prepare("SELECT uid FROM photo WHERE (id = :id AND user = :user)");
		$req->execute(array('id' => $id, 'user' => $user));
		$ret = $req->fetch();
		$uid = $ret['uid'];
		$req->closeCursor();
		$req = $this->db->prepare("DELETE FROM photo WHERE uid = :uid");
		$req->execute(array('uid' => $uid));
		return ($uid);
	}

}

?>

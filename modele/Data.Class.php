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

	public function getPhoto($uid) {
		$req = $this->db->prepare('SELECT id, nb_com FROM photo WHERE uid = :uid');
		$req->execute(array('uid' => $uid));
		$ret = $req->fetch();
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
		return (ceil($total / 6));
	}

	public function isLiked($uidph, $user) {
		$ret = false;
		$req = $this->db->prepare('SELECT id FROM photo_like WHERE user = :user AND uid_photo = :uidph');
		$req->execute(array('user' => $user, 'uidph' => $uidph));
		if ($req->fetch() !== false)
			$ret = true;
		$req->closeCursor();
		return $ret;
	}

	public function getGallery($p, $user) {
		$req = $this->db->prepare("SELECT uid, id, user, nb_like, nb_com FROM photo ORDER BY date_ajout DESC LIMIT $p, 6");
		$req->execute();
		$ret = array();
		while ($photo = $req->fetch())
		{
			$like = false;
			if ($this->isLiked($photo['uid'], $user))
				$like = true;
			$ret[] = array('uid' => $photo['uid'], 'id' => $photo['id'], 'user' => $photo['user'], 'nb_like' => $photo['nb_like'], 'liked' => $like, 'nb_com' => $photo['nb_com']);
		}
		$req->closeCursor();
		return $ret;
	}

	public function removeLikes($uid) {
		$req = $this->db->prepare("DELETE FROM photo_like WHERE uid_photo = :uidph");
		$req->execute(array('uidph' => $uid));
	}

	public function removePhoto($uid) {
		$req = $this->db->prepare("DELETE FROM photo WHERE uid = :uid");
		$req->execute(array('uid' => $uid));
		$this->removeLikes($uid);
	}

	public function addLike($user, $uidph) {
		$req = $this->db->prepare("INSERT INTO photo_like(user, uid_photo) VALUES(:user, :uidph)");
		$req->execute(array('user' => $user, 'uidph' => $uidph));
	}

	public function removeLike($user, $uidph) {
		$req = $this->db->prepare("DELETE FROM photo_like WHERE user = :user AND uid_photo = :uidph");
		$req->execute(array('user' => $user, 'uidph' => $uidph));
	}

	public function updateLike($action, $uidph, $user) {
		if ($action == 'like')
		{
			$i = 1;
			$this->addLike($user, $uidph);
		}
		else if ($action == 'unlike')
		{
			$i = -1;
			$this->removeLike($user, $uidph);
		}
		$req = $this->db->prepare("UPDATE photo SET nb_like = nb_like + :i WHERE uid = :uidph");
		$req->execute(array('i' => $i, 'uidph' => $uidph));
	}

}

?>

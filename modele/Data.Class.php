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
		$req = $this->db->prepare('SELECT id, id_user, nb_com FROM photo WHERE uid = :uid');
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

	public function getUserById($id) {
		$req = $this->db->prepare('SELECT login FROM user WHERE id = :id');
		$req->execute(array('id' => $id));
		$ret = $req->fetch();
		$req->closeCursor();
		return $ret;
	}

	public function getUserByMail($mail) {
		$req = $this->db->prepare('SELECT login FROM user WHERE email = :mail');
		$req->execute(array('mail' => $mail));
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
		$req = $this->db->prepare('INSERT INTO photo(id, id_user, date_ajout) VALUES(?, ?, ?)');
		$req->execute(array($info['nb_photo'], $info['id'], $date));

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
		$info = $this->getUserInfo($user);
		$ret = false;
		$req = $this->db->prepare('SELECT id FROM photo_like WHERE id_user = :user AND uid_photo = :uidph');
		$req->execute(array('user' => $info['id'], 'uidph' => $uidph));
		if ($req->fetch() !== false)
			$ret = true;
		$req->closeCursor();
		return $ret;
	}

	public function getGallery($p, $user) {
		$req = $this->db->prepare("SELECT uid, id, id_user, nb_like, nb_com FROM photo ORDER BY date_ajout DESC LIMIT $p, 6");
		$req->execute();
		$ret = array();
		while ($photo = $req->fetch())
		{
			$like = false;
			if ($this->isLiked($photo['uid'], $user))
				$like = true;
			$ret[] = array('uid' => $photo['uid'], 'id' => $photo['id'], 'user' => $photo['id_user'], 'nb_like' => $photo['nb_like'], 'liked' => $like, 'nb_com' => $photo['nb_com']);
		}
		$req->closeCursor();
		return $ret;
	}

	public function removeLikes($uid) {
		$req = $this->db->prepare("DELETE FROM photo_like WHERE uid_photo = :uidph");
		$req->execute(array('uidph' => $uid));
	}

	public function removeComments($uid) {
		$req = $this->db->prepare("DELETE FROM comments WHERE uid_photo = :uidph");
		$req->execute(array('uidph' => $uid));
	}

	public function removePhoto($uid) {
		$req = $this->db->prepare("DELETE FROM photo WHERE uid = :uid");
		$req->execute(array('uid' => $uid));
		$this->removeLikes($uid);
		$this->removeComments($uid);
	}

	public function addLike($user, $uidph) {
		$info = $this->getUserInfo($user);
		$req = $this->db->prepare("INSERT INTO photo_like(id_user, uid_photo) VALUES(:user, :uidph)");
		$req->execute(array('user' => $info['id'], 'uidph' => $uidph));
	}

	public function removeLike($user, $uidph) {
		$info = $this->getUserInfo($user);
		$req = $this->db->prepare("DELETE FROM photo_like WHERE id_user = :user AND uid_photo = :uidph");
		$req->execute(array('user' => $info['id'], 'uidph' => $uidph));
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

	public function addComment($user, $uidph, $com) {
		$info = $this->getUserInfo($user);
		$req = $this->db->prepare('INSERT INTO comments(id_user, uid_photo, content) VALUES(:user, :uidph, :com)');
		$req->execute(array('user' => $info['id'], 'uidph' => $uidph, 'com' => $com));

		$req = $this->db->prepare('UPDATE photo SET nb_com = nb_com + 1 WHERE uid = :uidph');
		$req->execute(array('uidph' => $uidph));
	}

	public function getComments($uidph) {
		$ret = array();
		$req = $this->db->prepare('SELECT id_user, content FROM comments WHERE uid_photo = :uidph ORDER BY id DESC');
		$req->execute(array('uidph' => $uidph));
		while ($comment = $req->fetch())
		{
			$ret[] = array('user' => $comment['id_user'], 'content' => $comment['content']);
		}
		$req->closeCursor();
		return $ret;
	}

	public function getPhotoAutor($uidph) {
		$req = $this->db->prepare('SELECT id_user FROM photo WHERE uid = :uidph');
		$req->execute(array('uidph' => $uidph));
		$ret = $req->fetch();
		$req->closeCursor();
		$autor = $this->getUserById($ret['id_user']);
		return $autor['login'];
	}
}

?>

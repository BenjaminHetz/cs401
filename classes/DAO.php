<?php
require_once 'KLogger.php';

class DAO {
	private $host     = "localhost";
	private $db       = "cs401";
	private $user     = "bhetz";
	private $password = "mK1em@go4%i4";
	private $log;

	public function __construct () {
		$this->log = new KLogger ("/var/log/bookcollector.log", KLogger::DEBUG);
	}

	public function getConnection() {
		$this->log->LogDebug("Attempting MySQL connection . . .");
	    try {
			$conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->password);
		} catch (Exception $e) {
			$this->log->LogFatal($e);
			exit;
		}
		$this->log->LogDebug("Got connection to MySQL");
		return $conn;
	}

	public function verifyLogin ($username, $password) {
		$conn = $this->getConnection();
		$this->log->LogDebug("Verifying login information");
		$query = $conn->prepare("SELECT username, password FROM user WHERE username = :username");
		$query->execute(array(':username' => $username));
		$data = $query->fetch();
		$hash = $data['password'];
		$this->log->LogDebug($hash);
		$this->log->LogDebug($password);
		if (password_verify($password, $hash)) {
		    $this->log->LogDebug("Passwords match");
			$_SESSION['username'] = $data['username'];
			header("Location:index.php");
			exit();
		}
	}

	public function createUser ($fName, $lName, $email, $newUsername, $newpassword) {
		$this->log->LogDebug("Creating User");
		$conn = $this->getConnection();
		$newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
		$q = $conn->prepare('insert into user (fName, lName, username, password, email, access) VALUES (:fName, :lName, :newUsername, :newpassword, :email, 0)');
		$q->execute(array(':fName' => $fName, ':lName' => $lName, ':newUsername' => $newUsername, ':newpassword' => $newpassword, ':email' => $email));
		$this->log->LogDebug("Successfully inserted user into table");
	}

	public function verifyNewUserCreds($username, $email, $password, $confirmPass) {
		$conn = $this->getConnection();
		$query = "select * from user where username=:username;";
		$q = $conn->prepare('select * from user where username = :username');
		$q->execute(array(':username' => $username));
		$returned = $q->fetch();
		unset($_SESSION['message']);
		if ($returned) {
		   	$this->log->LogDebug("We received data back so user already exists");
			$_SESSION['createUnameState'] = 'badBox';
			$_SESSION['message'][0] = "Username already in use";
			unset($_SESSION['input']['username']);
		}
		if (!($password === $confirmPass)) {
			$this->log->LogDebug("Passwords did not match");
			$_SESSION['createPassState'] = 'badBox';
			$_SESSION['message'][3] = "Passwords do not match";
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->log->LogDebug("Email is invalid");
			$_SESSION['createEmailState'] = 'badBox';
			$_SESSION['message'][4] = "Invalid Email";
			unset($_SESSION['input']['email']);
		}
		if (!$returned) {
			$this->log->LogDebug("We got no results back, so user doesn't exist");
			unset($_SESSION['createUnameState']);
		}
		if (!isset($username) || trim($username) == '') {
			$this->log->LogDebug("Empty username");
			$_SESSION['createUnameState'] = 'badBox';
			$_SESSION['message'][1] = "Username cannot be empty";
		}
		if ($password === $confirmPass) {
			$this->log->LogDebug("Passwords match confirmed");
			unset($_SESSION['createPassState']);
		}
		if (!isset($password) || trim($password) == '') {
			$this->log->LogDebug("Empty password");
			$_SESSION['createPassState'] = 'badBox';
			$_SESSION['message'][2] = "Password cannot be empty";
		}
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->log->LogDebug("Email confirmed valid");
			unset($_SESSION['createEmailState']);
		}
	}
	public function updateUser($fName, $lName, $email, $pass, $confirmpass) {
		$conn = $this->getConnection();
		$this->log->LogDebug("This is a log");
		$q = $conn->prepare('SELECT * FROM user WHERE username = :user');
		$q->execute(array(':user' => $_SESSION['username']));
		$data = $q->fetch();
		if (strcmp($fName, $data['fName']) != 0) {
			$fnameChange = $conn->prepare('UPDATE user SET fName = :fName WHERE username = :uname');
			$fnameChange->execute(array(':fName' => $fName, ':uname' => $_SESSION['username']));
			$this->log->LogDebug("Name Change");
		}
		if (strcmp($lName, $data['lName']) != 0) {
			$lnameChange = $conn->prepare('UPDATE user SET lName = :lName WHERE username = :uname');
			$lnameChange->execute(array(':lName' => $lName, ':uname' => $_SESSION['username']));
			$this->log->LogDebug("Name Change");
		}
		do {
			if (strcmp($email, $data['email']) != 0) {
					if (!isset($email) || trim($email) == '') {
						unset($_SESSION['updateEmailState']);
						unset($_SESSION['message'][1]);
						break;
					}
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$emailChange = $conn->prepare('UPDATE user SET email = :email WHERE username = :uname');
						$emailChange->execute(array(':email' => $email, ':uname' => $_SESSION['username']));
							}
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$_SESSION['updateEmailState'] = 'badBox';
						$_SESSION['message'][1] = "Invalid Email";
					}
			}
		}
		while (0);
		if (($pass === $confirmpass)) {
			$passChange = $conn->prepare('UPDATE user SET password = :pass WHERE username = :uname');
			$passChange->execute(array(':pass' => password_hash($pass, PASSWORD_DEFAULT), ':uname' => $_SESSION['username']));
		}
		if (!($pass === $confirmpass)) {
			$_SESSION['updatePassState'] = 'badBox';
			$_SESSION['message'][2] = 'Passwords do not match';
		}
	}
		
}

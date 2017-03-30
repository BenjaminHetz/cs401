<?php

session_start();
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
			$conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
							$this->password);
		} catch (Exception $e) {
			$this->log->LogFatal($e);
			exit;
		}
		$this->log->LogDebug("Got connection to MySQL");
		return $conn;
	}

	public function verifyLogin ($username, $password) {
		$this->log->LogDebug("Verifying login information");
		$conn = $this->getConnection();
		$loginQuery = "select username, password from user where username=:username";
		$q = $conn->prepare($loginQuery);
		$q->bindParam(":username", $username);
		$q->execute();
	}

	public function createUser ($fName, $lName, $email, $newUsername, $newpassword) {
		$this->log->LogDebug("Creating User");
		$conn = $this->getConnection();
		$newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
		$createQuery = 'insert into user (fName, lName, username, password, email, access) VALUES (:fName, :lName, :email, :newUsername, :newpassword, 0);';
		$q = $conn->prepare($createQuery);
		$_POST['QUERY'] = $q;
		if ($q->bindValue(':fName', $fName, PDO::PARAM_STR)) {
			$this->log->LogDebug("Bound fName");
		}
		if ($q->bindValue(':lName', $lName, PDO::PARAM_STR)) {
			$this->log->LogDebug("Bound lName");
		}
		if ($q->bindValue(':email', $email, PDO::PARAM_STR)) {
			$this->log->LogDebug("Bound email");
		}
		if ($q->bindValue(':newUsername', $newUsername, PDO::PARAM_STR)) {
			$this->log->LogDebug("Bound UserName");
		}
		if ($q->bindValue(':newpassword', $newpassword, PDO::PARAM_STR)) {
			$this->log->LogDebug("Bound password");
		}
		echo '<pre>';
		$q->debugDumpParams();
		echo '</pre>';
		#if (!($q->execute())) {
		#	$this->log->LogDebug("Damn didn't work");
		#}
		
	}

	public function verifyNewUserCreds($username, $email, $password, $confirmPass) {
		$conn = $this->getConnection();
		$query = "select * from user where username=:username;";
		$q = $conn->prepare($loginQuery);
		$q->bindParam(":username", $username);
		$q->execute();
		$returned = $q->fetch();
		unset($_SESSION['message']);
		if (!($returned == null)) {
			$_SESSION['createUnameState'] = 'bad';
			$_SESSION['message'][0] = "Username already in use";
			unset($_SESSION['input']['newusername']);
		}
		if (!($password === $confirmPass)) {
			$_SESSION['createPassState'] = 'bad';
			$_SESSION['message'][1] = "Passwords do not match";
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$_SESSION['createEmailState'] = 'bad';
			$_SESSION['message'][2] = "Invalid Email";
			unset($_SESSION['input']['email']);
		}
		if ($returned == null) {
			unset($_SESSION['createUnameState']);
		}
		if ($password === $confirmPass) {
			unset($_SESSION['createPassState']);
		}
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			unset($_SESSION['createEmailState']);
		}
	}	    
}

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
		$query = $conn->prepare("SELECT username, password, userid FROM user WHERE username = :username");
		$query->execute(array(':username' => $username));
		$this->log->LogDebug("Query was prepared");
		if ($query->execute()) {
		    $this->log->LogDebug("Statement was properly executed");
		    $query->debugDumpParams();
		} else {
		    $this->log->LogDebug("Failed to fetch credentials for {$username}");
		    exit();
		}
		$data = $query->fetch();
		$passfromDB = $data['password'];
		$this->log->LogDebug($passfromDB);
		#$password = password_hash($password, PASSWORD_DEFAULT);
		if ($password === $passfromDB) {
		        $this->log->LogDebug("Passwords match");
			$_SESSION['userid'] = $data['userid'];
			header("Location:index.php");
		}
	}

	public function createUser ($fName, $lName, $email, $newUsername, $newpassword) {
		$this->log->LogDebug("Creating User");
		$conn = $this->getConnection();
		$newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
		$q = $conn->prepare('insert into user (fName, lName, username, password, email, access) VALUES (:fName, :lName, :email, :newUsername, :newpassword, 0)');
		$q->execute(array(':fName' => $fName, ':lName' => $lName, ':newUsername' => $newUsername, ':newpassword' => $newpassword));
		header("Location:index.php");
		
	}

	public function verifyNewUserCreds($username, $email, $password, $confirmPass) {
		$conn = $this->getConnection();
		$query = "select * from user where username=:username;";
		$q = $conn->prepare($loginQuery);
		$q->bindValue(":username", $username);
		$q->execute();
		$returned = $q->fetch();
		unset($_SESSION['message']);
		if ($returned) {
		   	$this->log->LogDebug("We received data back so user already exists");
			$_SESSION['createUnameState'] = 'bad';
			$_SESSION['message'][0] = "Username already in use";
			unset($_SESSION['input']['newusername']);
		}
		if (!($password === $confirmPass)) {
		        $this->log->LogDebug("Passwords did not match");
			$_SESSION['createPassState'] = 'bad';
			$_SESSION['message'][1] = "Passwords do not match";
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		        $this->log->LogDebug("Email is invalid");
			$_SESSION['createEmailState'] = 'bad';
			$_SESSION['message'][2] = "Invalid Email";
			unset($_SESSION['input']['email']);
		}
		if (!$returned) {
		        $this->log->LogDebug("We got no results back, so user doesn't exist");
			unset($_SESSION['createUnameState']);
		}
		if ($password === $confirmPass) {
		        $this->log->LogDebug("Passwords match confirmed");
			unset($_SESSION['createPassState']);
		}
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		        $this->log->LogDebug("Email confirmed valid");
			unset($_SESSION['createEmailState']);
		}
	}	    
}

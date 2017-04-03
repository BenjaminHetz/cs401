<?php

session_start();
#We come here from login.php
require_once 'classes/DAO.php';
$access = new DAO();


#We are logging in
if (isset($_POST['login'])) {
	$password = $_POST['password'];
	$username = $_POST['username'];
	$access->verifyLogin ($username, $password);
}

#We are creating a new user
if (isset($_POST['create'])) {
	$username = $_POST['newusername'];
	$password = $_POST['newpassword'];
	$fName    = $_POST['fName'];
	$lName    = $_POST['lName'];
	$email    = $_POST['email'];
	$confirmpass = $_POST['confirmpass'];
	$_SESSION['input']['newusername'] = $username;
	$_SESSION['input']['fName'] = $fName;
	$_SESSION['input']['lName'] = $lName;
	$_SESSION['input']['email'] = $email;
	$access->verifynewUserCreds($username, $email, $password, $confirmpass);
	if (isset($_SESSION['createUnameState']) || isset($_SESSION['createPassState']) || isset($_SESSION['createEmailState'])) {
		#Verification Failed
		header("Location:login.php");
		exit;
	} else {
		$access->createUser($fName, $lName, $email, $username, $password);
		$_SESSION['username'] = $username;
		unset($_SESSION['input']);
		header("Location:index.php");
		exit;
	}
}
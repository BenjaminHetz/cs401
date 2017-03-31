<?php

session_start();
#We come here from login.php
require_once 'classes/DAO.php';
echo print_r($_POST);
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
	echo print_r("Create User");
	$access->verifynewUserCreds($username, $email, $password, $confirmpass);
	if (isset($_SESSION['createUnameState']) || isset($_SESSION['createPassState'])) {
		#Verification Failed
		header("Location:login.php");
		exit;
	} else {
		$access->createUser($fName, $lName, $email, $username, $password);
		$_SESSION['username'] = $username;
		header("Location:index.php");
		exit;
	}
}
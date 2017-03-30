<?php

session_start();

require_once 'classes/DAO.php';
$access = new DAO();

#We are logging in
if (isset($_POST['login'])) {
    $access->verifyLogin ($_POST['username'], $_POST['password']);
}

#We are creating a new user
if (isset($_POST['create'])) {
	$username = $_POST['newusername'];
	$password = $_POST['newpassword'];
	$confirmpass = $_POST['confirmpass'];
	#$email = $_POST['email'];
	$access->verifynewUserCreds($username, $email, $password, $confirmpass);
	if (isset($_SESSION['createUnameState']) || isset($_SESSION['createPassState'])) {
		#Verification Failed
		header("Location:login.php");
		exit;
	} else {
		$access->createUser($_POST['fName'], $_POST['lName'], $_POST['email'], $_POST['newusername'], $_POST['newpassword']);
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
	}
}
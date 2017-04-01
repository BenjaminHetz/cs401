<?php
session_start();
include_once('classes/DAO.php');

if(!(isset($_SESSION['username']))) {
	$_SESSION['message'][0] = 'Not Signed In';
header('Location: settings.php');
	exit;
}
$access = new DAO();
$access->updateUser($_POST['fName'], $_POST['lName'], $_POST['email'], $_POST['newpassword'], $_POST['confirmpass']);
header('Location: settings.php');
exit;
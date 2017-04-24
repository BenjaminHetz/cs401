<?php
session_start();

require_once('classes/DAO.php');

if (!isset($_SESSION['username'])) {
		header('Location: index.php');
		exit;
}

$dao = new DAO();
$dao->addBook($_POST, $_SESSION['username']);
header('Location: myBooks.php');
exit;
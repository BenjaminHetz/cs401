<html>
	<head>
		<title>Book Collectors</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/cs401.js" type="text/javascript"></script>
		<link href="assets/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	 <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> 
	</head>
	<body>
		<div id="header">
			<span id="title"><a href="index.php">Book Collectors</a></span>
			<span id="loginSpan">
	<?php
	if (isset($_SESSION['username'])) {
		echo 'Logged in as ' . $_SESSION['username'] . ', <a id="signin" href="logout.php">Sign out</a>';
	} else {
		echo '<a id="signin" href="login.php">Sign In/Sign Up</a>';
	}
	?>
			</span>
	    </div>
<?php
include_once('navigation.php');
?>

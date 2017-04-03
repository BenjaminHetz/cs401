<html>
	<head>
		<title>Book-Collectors</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>
		<link href="assets/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	</head>
	<body>
		<div id="header">
			<span id="logo">
				<a href="assets/logo.png"><img src="assets/logoSmall.png" id="logoIMG"/></a>
			</span>
			<span id="title"><a href="index.php">Book~Collectors</a></span>
			<span id="loginSpan">
	<?php
	if (isset($_SESSION['username'])) {
		echo '<a id="signin" href="logout.php">Sign out</a>';
	} else {
		echo '<a id="signin" href="login.php">Sign In/Sign Up</a>';
	}
	?>
			</span>
	    </div>
<?php if (isset($_SESSION['username'])) {
	include_once('loggedInNav.html');
} else {
	include_once('navigation.html');
}
?>
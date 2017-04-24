<?php
	session_start();
	include_once('header.php');
?>

<div id="Content">
<?php
if (!isset($_SESSION['username'])) {
	   
		echo '<h1 class="about" id="head"><a href="login.php">Log in or sign up</a> to get started</h1>';
}
?>
</div>
<?php
	include_once('footer.html');
?>
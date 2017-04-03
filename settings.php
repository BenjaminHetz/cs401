<?php
session_start();
if (!isset($_SESSION['username'])) {
	header('Location: index.php');
	exit;
}
	include_once('header.php');
?>
<div id="settings">
	<div>
		<form action="handler.php" method="POST">
			<div>
				<label>First Name</label>
				<input type="text" name="fName"> 
			</div>
			<div>
				<label>Last Name</label>
				<input type="text" name="lName">
			</div>
			<div>
				<label>Email</label>
				<input type="text" name="email"
		class=<?php echo '"' . $_SESSION['updateEmailState'] . '"';
unset($_SESSION['updateEmailState']);?>>
			</div>
			<div>
				<label>Password</label>
				<input type="password" name="newpassword"
		class=<?php echo '"' . $_SESSION['updatePassState'] . '"'?>>
			</div>
			<div>
				<label>Confirm Password</label>
				<input type="password" name="confirmpass"
		class=<?php echo '"' . $_SESSION['updatePassState'] . '"';
		unset($_SESSION['updatePassState']);?>>
			</div>
				<input type="submit" value="Submit">
		</form>
		<?php foreach($_SESSION['message'] as $message) {
			echo "<p class=errorMessage>" . $message . "</p>";
			unset($message);
		}?>
	</div>
</div>
<?php
	include_once('footer.html');

<?php
session_start();
if (isset($_SESSION['username'])) {
		header('Location: index.php');
		exit;
	}
include_once('header.php');
?>

<div id="oldUser" class="loginDiv">
	Sign in
	<div>
		<form action="loginHandler.php" method="POST">
			<div>
				<label>Username</label>
				<input type="text" name="username" value=<?php echo $_SESSION['input']['username']?>>
			</div>
			<div>
				<label>Password</label>
				<input type="password" name="password">
			</div>
				<input type="submit" value="Submit" name="login">
		</form>
	</div>
</div>

<div id="newUser" class="loginDiv">
	Not a Member? Sign up Here
	<div>
		<form action="loginHandler.php" method="POST">
			<div>
				<label>First Name</label>
				<input type="text" name="fName" value=<?php echo '"' . $_SESSION['input']['fName'] . '"'?>>
			</div>
			<div>
				<label>Last Name</label>
				<input type="text" name="lName" value=<?php echo '"' . $_SESSION['input']['lName'] . '"'?>>
			</div>
			<div>
				<label>Email</label>
				<input type="text" name="email"
	value=<?php echo '"' . $_SESSION['input']['email'] . '"'?>>
			</div>
			<div>
				<label>Username</label>
				<input type="text" name="newusername"
	class=<?php echo '"' . $_SESSION['createUnameState'] . '"'; unset($_SESSION['createUnameState']);?>
	value=<?php echo '"' . $_SESSION['input']['newusername'] . '"'?>>
			</div>
			<div>
				<label>Password</label>
				<input type="password" name="newpassword"
	class=<?php echo '"' . $_SESSION['createPassState'] . '"'?>>
			</div>
			<div>
				<label>Confirm Password</label>
				<input type="password" name="confirmpass"
																	class=<?php echo '"' . $_SESSION['createPassState'] . '"'; unset($_SESSION['createPassState']);?>>
			</div>
				<input type="submit" value="Submit" name="create">
		</form>
	<!--Showing error messages under the create user box Clear it out after it has been shown so it does not persist--!>
	<?php
    foreach($_SESSION['message'] as $message) {
        echo "<p class=errorMessage>" . $message . "</p>";
	unset($message);
    }
?>
	</div>
</div>
<?php
	include_once('footer.html');
?>
<?php
	include_once('header.html');
?>

<div id="oldUser" class="loginDiv">
	Sign in
	<div>
		<!--<form action="handler.php" method="POST">-->
		<form action="myBooks.php" method="GET">
			<div>
				<label>Username</label>
				<input type="text" name="username">
			</div>
			<div>
				<label>Password</label>
				<input type="password" name="password">
			</div>
				<input type="submit">
		</form>
	</div>
</div>

<div id="newUser" class="loginDiv">
	Not a Member? Sign up Here
	<div>
		<form>
			<div>
				<label>First Name</label>
				<input type="text" name="fName">
			</div>
			<div>
				<label>Last Name</label>
				<input type="text" name="lName">
			</div>
			<div>
				<label>eMail</label>
				<input type="text" name="email">
			</div>
			<div>
				<label>Username</label>
				<input type="text" name="newusername">
			</div>
			<div>
				<label>Password</label>
				<input type="password" name="newpassword">
			</div>
			<div>
				<label>Confirm Password</label>
				<input type="password" name="confirmpass">
			</div>
				<input type="submit">
		</form>
	</div>
</div>
<?php
	include_once('footer.html');

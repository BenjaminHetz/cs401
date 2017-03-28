<?php
	include_once('header.html');
	include_once('loggedInNav.html');
?>
<div id="settings">
	<div>
		<!--<form action="handler.php" method="POST">-->
		<form action="settings.php" method="GET">
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

<?php
session_start();
if (!isset($_SESSION['username'])) {
	header('Location: index.php');
	exit;
}
	include_once('header.php');
require_once('classes/DAO.php');
$dao = new DAO();
$results = $dao->getCredentials($_SESSION['username']);
?>
<div id="settings">
	<div>
		<form action="handler.php" method="POST">
			<div>
				<label>First Name</label>
				<input type="text" name="fName" value=<?php echo '"' . $results[1] . '"'?>> 
			</div>
			<div>
				<label>Last Name</label>
				<input type="text" name="lName" value=<?php echo '"' . $results[2] . '"'?>>
			</div>
			<div>
				<label>Email</label>
				<input type="text" name="email" value=<?php echo '"' . $results[5] . '"'?>
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
				<input id="submitButton" type="submit" value="Submit">
		</form>
		<?php foreach($_SESSION['message'] as $message) {
			echo "<p class=errorMessage>" . $message . "</p>";
		}
			unset($_SESSION['message'])?>
	</div>
</div>
<?php
	include_once('footer.html');

<?php
session_start();
if (!isset($_SESSION['username'])) {
header('Location: index.php');
exit;
}
	include_once('header.php');
require_once('classes/DAO.php');
require_once('classes/Render.php');
$dao = new DAO();
?>

<div id="Content">
	<div id="add" class="addform">
	Add a book
	<form action="addBook.php" method="POST" id="addBook">
	<div>
				<label class="addform">Title</label>
				<input type="text" id="booktitle" name="title">
			</div>
			<div>
				<label class="addform">Author</label>
				<input type="text" id="bookauthor" name="author">
			</div>
				<input type="submit" value="Submit" name="login">
	</form>
	</div>
	<div id="books">
		<?php
Render::renderTable($dao->getBooks($_SESSION['username']));
?>
	</div>
</div>
<?php
	include_once('footer.html');
?>
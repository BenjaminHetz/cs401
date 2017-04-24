<div id="navigation">
	 <ul class=navButtons>
	 <li
	 <?php
	 if ($_SERVER['SCRIPT_NAME'] === '/index.php') {
		 echo "id=current";
	 }?>
		 ><a href="index.php">Home</a></li>
				 <li
						 <?php
				 if (!isset($_SESSION['username'])) {
					 echo "class=hidden";
						 } if ($_SERVER['SCRIPT_NAME'] === '/myBooks.php') {
					 echo "id=current";
				 }
				 ?>><a href="myBooks.php">My Books</a></li>
				 <li
						 <?php
				 if (!isset($_SESSION['username'])) {
					 echo "class=hidden";
				 } if ($_SERVER['SCRIPT_NAME'] === '/settings.php') {
					 echo "id=current";
				 }
				 ?>><a href="settings.php">Account Settings</a></li>
			</ul>
</div>

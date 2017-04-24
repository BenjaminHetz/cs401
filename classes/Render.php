<?php
class Render {

	public static function renderTable($rows) {
		$log = new KLogger ("/var/log/render.log", KLogger::INFO);
		$log->logInfo("Rendering books");

		$table = "
<table id = 'books'>
<thead>
<tr>
<th>Title</th>
<th>Author</th>
</tr>
</thead>";

		foreach($rows as $row) {
			$table .= "<tr>
<td>" . htmlentities($row['title']) . "</td>" . "<td>" . htmlentities($row['author']) . "</td></tr>";
		}
		$table .= "</table>";
		echo $table;
	}
}
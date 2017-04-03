<?php
session_start();
	include_once('header.php');
?>

<div id="Content">
	<div id="filters">
	<select name=sort>
		<option value="" selected>Sort By</option>
		<option value="Author">Author</option>
		<option value="Title">Title</option>
		<option value="Genre">Genre</option>
		<option value="pubDate">Publish Date</option>
		<option value="readDate">Read Date</option>
	</select>
	<form action="search.php" method="POST">
			<div id="searchBox">
				<input type="text" name="q" value="Search">
		<input type="submit" name="search" value="Submit">
			</div>
		</form>
	</div>
	<div id="books">
		<table>
		<?php
		$results = $_POST['jsonResults'];
$maxIndex = 25;
		$index = 0;
while($index < $maxIndex && $results->docs[$index] !== null) {
	if ($index % 0 === 0) {
		echo '<tr> <td> <a href=http://openlibrary.org/<img src=http://covers.openlibrary.org/b/ISBN/' .$results->docs[$index % 5]->isbn[1] . '-S.jpg>';?>
			<tr>
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
				<td>7</td>
				<td>8</td>
				<td>9</td>
			</tr>
			<tr>
				<td>10</td>
				<td>11</td>
				<td>12</td>
				<td>13</td>
				<td>14</td>
				<td>15</td>
				<td>16</td>
				<td>17</td>
				<td>18</td>
			</tr>
			<tr>
				<td>19</td>
				<td>20</td>
				<td>21</td>
				<td>22</td>
				<td>23</td>
				<td>24</td>
				<td>25</td>
				<td>26</td>
				<td>27</td>
			</tr>
		</table>
	</div>
</div>
<?php
	include_once('footer.html');
?>
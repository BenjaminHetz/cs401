<?php
require_once('classes/DAO.php');
$dao = new DAO();
$doc = '/home/bhetz/ol_dump_works_2017-03-31.txt';
$missing = 0;
$added = 0;
$entries = 0;

if (($handle = fopen("$doc", "r")) !== FALSE) {
    while(($data = fgets($handle))) {
		$data = substr($data, 59);
		$data = json_decode($data);
		if ($data !== null) {
			$entries++;
			if (!property_exists($data, 'covers')) {
				$data->covers = null;
			}
			if (!property_exists($data, 'authors')) {
				$data->authors = null;
			}
			if (property_exists($data, 'title') && property_exists($data, 'key')) {
				$dao->addBook($data);
				$added++;
			}
			else {
				$missing++;
			}
		}
	}
	echo "Entries Missed: " . $missing;
	echo "Entries Added: " . $added;
	echo "Total entries in file: " . $entries;
}
?>
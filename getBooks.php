<?php
require_once('classes/DAO.php');
$dao = new DAO();
$doc = '/home/bhetz/ol_dump_works_2017-03-31.txt';
if (($handle = fopen("$doc", "r")) !== FALSE) {
    while(($data = fgets($handle))) {
		$data = substr($data, 59);
		$data = json_decode($data);
		if ($data !== null) {
			if (!property_exists($data, 'covers')) {
				$data->covers = null;
			}
			if (property_exists($data, 'title') && property_exists($data, 'key') && property_exists($data, 'authors') && property_exists($data->authors[0], 'author')) {
				$dao->addBook($data);
			}
		}
	}
}
?>
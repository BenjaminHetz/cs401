<?php

require_once('classes/DAO.php');
$dao = new DAO();
$doc = '/home/bhetz/ol_dump_authors_2017-03-31.txt';
if (($handle = fopen("$doc", "r")) !== FALSE) {
	while (($data = fgets($handle))) {
		$data = substr($data, 61);
		$data = json_decode($data);
		if ($data !== null) {
			if (property_exists($data, 'key') && property_exists($data, 'name')) {
				$dao->addAuthor($data);
			}
		}
	}
}
<?php

$doc = '/home/bhetz/ol_dump_works_2017-03-31.txt';
if (($handle = fopen("$doc", "r")) !== FALSE) {
    if (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$data = fgetcsv($handle, 1000, ",");
		$title = substr($data[0], 70, -1);
		$title = str_replace(' ', '+', $title);
		$bookID = "OL49487W";
		$request = 'http://openlibrary.org/search.json?title=' . $title;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $request);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$ret = curl_exec($ch);
		if ($jsonObj = json_decode($ret)) {
			#echo $jsonObj['start'];
			echo $jsonObj->num_found;
			$cover = 3140444;
			$coverRequest = 'http://covers.openlibrary.org/b/ISBN/' . $jsonObj->docs[0]->isbn[1] . '-S.jpg';
			$ret = curl_exec($ch);
		}
	}
}
?>
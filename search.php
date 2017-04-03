<?php
if (!isset($_POST['q']) {
		header(Location: $_SERVER['HTTP_REFERER']);
		exit;
	}
	else {
		$title = $_POST['q'];
		$title = str_replace(' ', '+', $title);
		$request = 'http://openlibrary.org/search.json?title=' . $title;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $request);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$ret = curl_exec($ch);
		$jsonObj = json_decode($ret);
		$_POST['jsonResults'] = $jsonObj;
		curl_close($ch);
		header(Location: $_SERVER['HTTP_REFERER']);
		exit;
	}
	?>
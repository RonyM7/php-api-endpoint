<?php
	//URL parameters
	$dataType = $_GET['type'];
	$dataType = filter_var($dataType, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$dataID = $_GET['id'];
	$dataID = filter_var($dataID, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$dataPage = $_GET['page'];
	$dataPage = filter_var($dataPage, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$dataItems_per_page = $_GET['items_per_page'];
	$dataItems_per_page = filter_var($dataItems_per_page, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$dataName = htmlspecialchars($_GET['full_name']);
	$dataName = filter_var($dataName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$host = '';

	if (isset($dataType)){
		switch ($dataType) {

		  case 'specialty':
		    $url = $host.'/api/specialty?_format=json';
		    break;

		  case 'gender':
		    $url = $host.'/api/gender?_format=json';
		    break;

		   case 'languages':
		    $url = $host.'/api/languages?_format=json';
		    break;

		  default:
		    $url = '';
		}
		
	}

	if ($_SERVER['SERVER_NAME'] == '') {

	  $username='api';
	  $password='';

	}else{

	  $username='api-local';
	  $password='';

	}
	//retrieving data
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

	header('Content-Type: application/json');

	$result = curl_exec($ch);

	if (curl_errno($ch)) {
	    echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	//displaying data
	echo $result;

?>
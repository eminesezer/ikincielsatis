<?php
$response=array();
	
	$count='Turkey';
	$city="BURSA";
		require_once 'DatabaseFiller.php';
		$func=new DatabaseFiller();
	$result=$func-> databaseFiller();

		$response['error']=false;
		$response['message']=$result;

echo json_encode($response);

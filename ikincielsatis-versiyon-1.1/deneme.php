<?php
$response=array();
	
	$count='Turkey';
	$city="BURSA";
		require_once 'Functions.php';
		$func=new Functions();
	$result=$func-> getCountity($city);
		$response['error']=false;
		$response['message']=$result;

echo json_encode($response);

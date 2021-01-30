<?php
$response = array();
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
	require_once '../Functions.php';
	$db = new Functions();
	$newUserResult = $db->getMyProducts();
	$response['error']=false;
	$response['message']=$newUserResult;
	
}
else{
	$response['error']=true;
	$response['message']='Yetkisiz giriş';
}

echo json_encode($response);
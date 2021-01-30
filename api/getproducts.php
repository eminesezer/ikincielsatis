<?php
$response = array();
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
	require_once '../Functions.php';
	$func=new Functions();
	$newUserResult = $func->getAllProducts();
	$response['error']=false;
	$response['message']=$newUserResult;
}
else{
	$response['error']=true;
	$response['message']='Yetkisiz giriş';
}

echo json_encode($response);
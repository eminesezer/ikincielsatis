<?php
session_start(); 
$response=array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	$json=file_get_contents('php://input');
	$nesne=json_decode($json);
	$nesne=(array)$nesne;
	$count=$nesne["Country"];	
		require_once '../Functions.php';
		$func=new Functions();
		$result=$func->cikisYap();
		$response['error']=false;
		$response['message']=$result;
}
else {
	$response['error']=true;
	$response['message']='Yetkisiz Erişim';
}
echo json_encode($response);

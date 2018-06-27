<?php
session_start();
$response=array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	$json=file_get_contents('php://input');
	$nesne=json_decode($json);
	$nesne=(array)$nesne;
	$level=$nesne["profile"];
	$user_id=$_SESSION['id'];
	require_once '../Functions.php';
	$func=new Functions();
	$result=$func->fillUserInfo($user_id);
	$response['error']=false;
	$response['message']=$result;
}
else {
	$response['error']=true;
	$response['message']='Yetkisiz Erişim';
}
echo json_encode($response);

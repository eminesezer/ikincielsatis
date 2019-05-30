<?php
$response=array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	$json=file_get_contents('php://input');
	$nesne=json_decode($json);
	$nesne=(array)$nesne;
	$user=$nesne["username"];	
	require_once '../Functions.php';
	$func=new Functions();
	$result=$func->checkUsername($user);
	if($result==1){
		$response['error']=true;
		$response['message']='Bu kullanıcı adı kullanımda!!!';
	}
	else {
		$response['error']=false;
		$response['message']=$result;
	}
}
else {
	$response['error']=true;
	$response['message']='Yetkisiz Erişim';
}
echo json_encode($response);

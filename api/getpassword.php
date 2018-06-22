<?php 
$response=array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	$json=file_get_contents('php://input');
	$nesne=json_decode($json);
	$nesne=(array)$nesne;
	$username=$nesne["username"];
	require_once '../Functions.php';
	$func=new Functions();
	$result=$func->getPasswordPage($username);
	if($result==1){
		$response['error']=false;
		$response['message']='getpass.html';
	}
	else {
		$response['error']=true;
		$response['message']=$result;
	}
}
else {
	$response['error']=true;
	$response['message']='Yetkisiz Erişim';
}
echo json_encode($response);
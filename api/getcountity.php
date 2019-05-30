<?php
$response=array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	$json=file_get_contents('php://input');
	$nesne=json_decode($json);
	$nesne=(array)$nesne;
	$city=$nesne["City"];		
		require_once '../Functions.php';
		$func=new Functions();
		$result=$func->getCountity($city);
		$response['error']=false;
		$response['message']=$result;
}
else {
	$response['error']=true;
	$response['message']='Yetkisiz Erişim';
}
echo json_encode($response);

<?php
$response=array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	require_once '../Functions.php';
	$func=new Functions();
	$result=$func->fillproducts();
	$response['error']=false;
	$response['message']=$result;
}
else {
	$response['error']=true;
	$response['message']='Yetkisiz Erişim';
}
echo json_encode($response);

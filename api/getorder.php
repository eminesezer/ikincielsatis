<?php
$response=array();
if($_SERVER['REQUEST_METHOD']=='GET'){
	require_once '../Functions.php';
	$func=new Functions();
	$newUserResult = $func->getAllOrders();
	$response['error']=false;
	$response['level']=$newUserResult;
}
else {
	$response['error']=true;
	$response['message']='Yetkisiz Erişim';
}
echo json_encode($response);



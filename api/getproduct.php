<?php
$response=array();
session_start();
if($_SERVER['REQUEST_METHOD']=='GET'){
	require_once '../Functions.php';
	$id=$_SESSION['productid'];
	$func=new Functions();
	$result=$func->getProductsLink($id);
	$response['error']=false;
}
else {
	$response['error']=true;
	$response['message']='Yetkisiz Erişim';
}
echo json_encode($response);

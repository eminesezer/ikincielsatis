<?php
session_start();
$response=array();
if($_SERVER['REQUEST_METHOD']=='GET'){
		$_SESSION['id']=(-1);
		$_SESSION['username']=" ";
		$_SESSION['userlastname']=" ";
		$_SESSION['level']=0;
		$_SESSION['productid']=0;
		$response['error']=false;
}
else {
	$response['error']=true;
	$response['message']='Yetkisiz Erişim';
}
echo json_encode($response);
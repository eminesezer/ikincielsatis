<?php
session_start(); 
$response=array();
if($_SERVER['REQUEST_METHOD']=='GET'){
	$level=$_SESSION['level'];
	if($level==""){
		$level=(-1);
		$_SESSION['level']=(-1);
	}
	$response['error']=false;
	$response['level']=$level;
}
else {
	$response['error']=true;
	$response['message']='Yetkisiz Erişim';
}
echo json_encode($response);



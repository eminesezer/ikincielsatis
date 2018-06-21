<?php
session_start();
$response=array();
if($_SERVER['REQUEST_METHOD']=='POST'){
		require_once '../Functions.php';
		$func=new Functions();
		$result=$func->getUserInfoFromSESSION();
		$response['checker']=true;
		if($result['id']<1){
			$response['error']=true;
			$response['checker']=false;
			$response['message']='login.html';
		}
		else{
			$response['error']=false;
			$response['message']=$_SESSION['username']." ".$_SESSION['userlastname'];
		}
}
else {
	$response['error']=true;
	$response['message']='Yetkisiz Erişim';
}
echo json_encode($response);

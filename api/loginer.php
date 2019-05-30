<?php
session_start();
$response=array();
if($_SERVER['REQUEST_METHOD']=='GET'){
			$response['error']=false;
			$response['name']="Giriş Yap";
			$response['message']='login.html';
}
else {
	$response['error']=true;
	$response['message']='Yetkisiz Erişim';
}
echo json_encode($response);

<?php
session_start(); 
$response=array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	$json=file_get_contents('php://input');
	$nesne=json_decode($json);
	$nesne=(array)$nesne;
	$pass=$nesne["pass1"];
	$pass2=$nesne["pass2"];
	if($_SESSION["username"]!=""){
		if($pass==$pass2){
			require_once '../Functions.php';
			$func=new Functions();
			
			$result=$func->changePass($pass,$pass2);
			if($result==1){
				$response['error']=false;
				$response['message']='login.html';
			}
			else{
				$response['error']=true;
				$response['message']='Kullanıcı eşleşmiyor...';
			}
			
		}	
		else {
			$response['error']=true;
			$response['message']='Girdiğiniz şifreler eşleşmiyor...';

		}
	}
	else {
		$response['error']=true;
		$response['message']='Lütfen daha önce işlem yapmaya başladığınız kullanıcıyla devam ediniz.';
	}
}
else {
	$response['error']=true;
	$response['message']='Yetkisiz Erişim';
}
echo json_encode($response);
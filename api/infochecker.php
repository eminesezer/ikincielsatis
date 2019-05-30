<?php
session_start(); 
$response=array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	$json=file_get_contents('php://input');
	$nesne=json_decode($json);
	$nesne=(array)$nesne;
	$name=$nesne["name"];
	$lastname=$nesne["lastname"];
	$phone=$nesne["phone"];
	$birthday=$nesne["birthday"];
	$email=$nesne["email"];
	$city=$nesne["city"];
	$countity=$nesne["countity"];
	$username=$nesne["username"];
	if($_SESSION["username"]==$username){
		require_once '../Functions.php';
		$func=new Functions();
		$result=$func->infoChecker($username,$name,$lastname,$phone,$birthday,$email,$city,$countity);
		if($result==1){
			$response['error']=false;
			$response['message']='changepassword.html';
		}
		else{
			$response['error']=true;
			$response['message']='Kullanıcı eşleşmiyor...';
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
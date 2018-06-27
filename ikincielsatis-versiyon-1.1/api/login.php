<?php
session_start(); 
$response=array();
// var data = JSON.stringify({ "username": name, "password": pass });
if($_SERVER['REQUEST_METHOD']=='POST'){
	$json=file_get_contents('php://input');
	$nesne=json_decode($json);
	$nesne=(array)$nesne;
	$username=$nesne['username'];
	$userpass=$nesne['password'];
	require_once '../Functions.php';
	$_SESSION['id']=0;
	$func=new Functions();
	$result=$func->login($username, $userpass);
	$response['error']=true;
	$response['message']=$username." ".$userpass." ".$_SESSION['productid']." ";
if ($result==0 && $_SESSION['productid']>0){
		$response['error']=false;
		$response['id'] = $_SESSION['id'];
		$response['username']= $_SESSION['username'];
		$response['userlastname']= $_SESSION['userlastname'];
		$response['message']="product.html";
	}
	else if($result==0){
		$response['error']=false;
		$response['id'] = $_SESSION['id'];
		$response['username']= $_SESSION['username'];
		$response['userlastname']= $_SESSION['userlastname'];
		$response['message']="homepage.html";
	}
	else if($result==1){
		$response['error']=true;
		$response['message']="Yanlış şifre girdiniz";
		$response['id'] = (-1);
		$response['username']= "";
		$response['userlastname']= "";}
	else if($result==2){
		$response['error']=true;
		$response['message']="Kayıtlı kullanıcı bulunamadı";
		$response['id'] = (-1);
		$response['username']= "";
		$response['userlastname']= "";}
}
else {
	$response['error']=true;
	$response['message']="Yetkisiz Erişim";
}
echo json_encode($response);

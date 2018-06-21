<?php
session_start(); 
$response=array();
//"formuls":formlab, "country":country, "city":city, 
//"countity":countity,"pass1":password, "pass2":pass});
				
if($_SERVER['REQUEST_METHOD']=='POST'){
	$json=file_get_contents('php://input');
	$nesne=json_decode($json);
	$nesne=(array)$nesne;
	$name=$nesne["name"];
	$lastname=$nesne["lastname"];
	$phone=$nesne["phone"];
	$username=$nesne["username"];
	$email=$nesne["email"];
	$address=$nesne["address"];
	$postcode=$nesne["postcode"];
	$answer=$nesne["answer"];
	$question=$nesne["question"];
	$birthday=$nesne["birthday"];
	$formuls=$nesne["formuls"];
	$country=$nesne["country"];
	$city=$nesne["city"];
	$countity=$nesne["countity"];
	$pass1=$nesne["pass1"];
	$pass2=$nesne["pass2"];
	$checker=$nesne["checker"];
	
	require_once '../Functions.php';
	$func=new Functions();
	$sonuc=$func->checkUsername($username);
	if($sonuc==1){
		$response['error']=true;
		$response['message']='Bu kullanıcı adı kullanımda!!!';
	}
	else if($pass1!=$pass2){
		$response['error']=true;
		$response['message']='Şifreler eşleşmiyor. Lütfen kontrol edip tekrar deneyin...';
	}
	else if($name==""||$lastname==""||$phone==""||$username==""||$email==""||$address==""||$postcode==""||$answer==""||$question==""||$birthday==""||$formuls==0||$country==""||$city==""||$countity==""||$pass1==""||$pass2==""){	
		$response['error']=true;
		$response['message']='Boş Alan Bırakmyaınız... Lütfen Boş Alanları Doldurup Tekrar Deneyiniz.';	
	}
	else if($formuls==0){
		$response['error']=true;
		$response['message']='Form tamamlanmadan işlem gerçekleştirilemiyor...';
	}
	else if($checker!=1){
		$response['error']=true;
		$response['message']='Kullanıcı adı kullanımda...';
	}
	else if($formuls==1 && $checker==1){
		$result=$func->getRegistered($name, $lastname, $phone, $username, $email, $address, $postcode, $answer, $question, $birthday, $formuls, $country, $city, $countity, $pass1, $pass2, $checker);
		if($result['error']==false){
			$response['message']=$result['message'];
			$response['error']=false;}
		else{
			$response['error']=true;
			$response['message']=$result['message'];
		}
	}
	else{
		$response['error']=true;
		$response['message']='Şu anda sunucuya erişilemiyor...';
	}
}
else {
	$response['error']=true;
	$response['message']='Yetkisiz Erişim';
}
echo json_encode($response);

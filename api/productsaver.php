<?php
$response=array();
			
if($_SERVER['REQUEST_METHOD']=='POST'){
	$json=file_get_contents('php://input');
	$nesne=json_decode($json);
	$nesne=(array)$nesne;
	$productname=$nesne['productname'];
	$files=$nesne['file'];
	$technic=$nesne['producttechnic'];
	$price=$nesne['productprice'];
	if($files==""){
		$files="../img/noimage.jpg";
	}
	require_once '../Functions.php';
	$func=new Functions();
	$result=$func->addProduct($productname, $files, $technic, $price);
		$response['error']=true;
		$response['message']=$result;
	/*if($result==1){
		$response['error']=false;
		$response['message']="Ürün kaydedildi...";
		$response['links']="myproducts.html";
	}
	else {
		$response['error']=true;
		$response['message']='Bir sorun oluştu.';
	}*/
}
else {
	$response['error']=true;
	$response['message']='Yetkisiz Erişim';
}
echo json_encode($response);

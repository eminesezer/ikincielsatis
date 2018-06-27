 <?php
$response=array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	$json=file_get_contents('php://input');
	$nesne=json_decode($json);
	$nesne=(array)$nesne;
	$id=$nesne['orderid'];
	$name=$nesne['pagename'];
	$link=$nesne['pagelink'];
	require_once '../Functions.php';
	$func=new Functions();
	$result=$func->savePage($id, $name, $link);
	if($result==1){
		$response['error']=false;
		$response['message']="Başarıyla kayıt edildi.";
	}
	else {$response['error']=true; $response['message']='Bir sorun oluştu.';}
}
else {
	$response['error']=true;
	$response['message']='Yetkisiz Erişim';
}
echo json_encode($response);

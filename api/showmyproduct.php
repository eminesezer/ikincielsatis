 <?php
$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$json=file_get_contents('php://input');
	$nesne=json_decode($json);
	$nesne=(array)$nesne;
	$count=$nesne["id"];	
	require_once '../Functions.php';
	$db = new Functions();
	$newUserResult = $db->showMyProduct($count);
	$response['error']=false;
	$response['message']=$newUserResult;
	}
	else{
		$response['error']=true;
		$response['message']="İzinsiz Giriş";
	}
}
else{
	$response['error']=true;
	$response['message']='Yetkisiz giriş';
}

echo json_encode($response);
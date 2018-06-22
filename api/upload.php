<?php 
$response=array();
if($_SERVER['REQUEST_METHOD']=='POST'){
		$response['error']=false;/*controller for image*/
		$filename = $_FILES['file']['name'];
		require_once '../Functions.php';
		$db=new Functions();
		$location = "../products/";
		$file=$location.$filename;
		$imageFileType = pathinfo($file,PATHINFO_EXTENSION);
		// Check image format
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		 && $imageFileType != "gif" ) {	$response['error']=true; $response['message']='Please load an image formatted as .PNG, .JPEG, .JPG';}
		else {
			if(!file_exists($location)){
				if(!mkdir($location,0755)){
					$response['error']=true;
					$response['message']='Directory couldn\'t build for maintenance.';
				}
			}
			if($response['error']==false){
				/* Upload file */
				if(move_uploaded_file($_FILES['file']['tmp_name'],$file)){
					$response['message']=$file;
				}
				else{$response['error']=true;
				$response['message']='Couldn\'t upload file...';}
			}
		}
}
else {$response['error']=true;
$response['message']='You don\'t have permission for that...';}
echo json_encode($response);
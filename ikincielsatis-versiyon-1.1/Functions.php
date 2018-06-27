<?php 
 class Functions{
	 private $baglan;
	 function __construct(){
		require_once dirname(__FILE__) . '/Config.php';
        require_once dirname(__FILE__) . '/DbConnector.php';
		
		$db = new DbConnector();
		$this->baglan = $db->connect();
		
		date_default_timezone_set('Europe/Istanbul');
		 
	 }
	 public function login($username, $password){
		$stmt_login=$this->baglan->prepare("select id FROM users where username=?");
		$stmt_login->bind_param("s", $username);
		$controller=$stmt_login->execute();
		$stmt_login->store_result();
		$stmt_login->bind_result($bid);
		$numofrows=$stmt_login->num_rows;
		if($numofrows>0){
			$stmt_login->fetch();
			$stmt_login->free_result();
			$stmt_login->close();
			$stmt_passchecker=$this->baglan->prepare("select id, name, lastname, level FROM users where username=? AND userpass=?");
			$stmt_passchecker->bind_param("ss", $username, $password);
			$stmt_passchecker->execute();
			$stmt_passchecker->store_result();
			$stmt_passchecker->bind_result($userid, $name, $lastname, $level);
			$numrows=$stmt_passchecker->num_rows;
			if($numrows>0){
				$stmt_passchecker->fetch();
				$_SESSION['id']=$userid;
				$_SESSION['username']=$name;
				$_SESSION['userlastname']=$lastname;
				$_SESSION['level']=$level;
				$stmt_passchecker->free_result();
				$stmt_passchecker->close();
				return 0;//user is checked and exist.
			}
			else{
				$stmt_passchecker->free_result();
				$stmt_passchecker->close();
				return 1;//password is wrong
			}
		}
		else {
			$stmt_login->free_result();
			$stmt_login->close();
			return 2;//user is not exist
		}
	} 
 
 public function getPasswordPage($username){
	 $result=0;
	 $stmt_login=$this->baglan->prepare("select id FROM users where username=? OR email=?");
	$stmt_login->bind_param("ss", $username, $username);	
	$stmt_login->execute();
	$stmt_login->store_result();
	$stmt_login->bind_result($userid);	
	$numofrows=$stmt_login->num_rows;
	if($numofrows>0){
			$stmt_login->fetch();
			$_SESSION["username"]=$userid;
			$stmt_login->free_result();
			$stmt_login->close();
			$result=1;
		}
		return $result;
 }
 public function infoChecker($username,$name,$lastname,$phone,$birthday,$email,$city,$countity){
	 $result=0;
	 $stmt_login=$this->baglan->prepare("select name, lastname, phone, birthday, email, city, countity FROM users where username=?");
		$stmt_login->bind_param("s", $username);
		$stmt_login->execute();
		$stmt_login->store_result();
		$stmt_login->bind_result($_name, $_lastname, $_phone, $_birthday, $_email, $_city, $_countity);	
		$numofrows=$stmt_login->num_rows;
		if($numofrows>0){
			$stmt_login->fetch();
			if(($_name==$name)&&($lastname==$_lastname)&&($phone==$_phone)&&($birthday==$_birthday)&&($email==$_email)&&($city==$_city)&&($countity==$_countity)){
				$result=1;
				$_SESSION["username"]=$username;	
			}
			$stmt_login->free_result();
			$stmt_login->close();
		}
	return $result;
 }
 public function changePass($pass,$pass2){
	 $result=0;
	 $id=$_SESSION["id"];
	 $stmt_login=$this->baglan->prepare("UPDATE `users` SET `userpass`=?,`password`=? WHERE `username`=?");
	$stmt_login->bind_param("ssi",$pass, $pass2, $id);
	$controller=$stmt_login->execute();	
	return $controller;
	if($stmt_login->errorno){
		$_SESSION["id"]=(-1);
		$_SESSION["name"]="";
		$_SESSION["lastname"]="";
		return 1;
	}
	else{
		return 0;
	}
	$stmt_login->free_result();
	$stmt_login->close();
 }
 
	public function getCountry(){
	$oneData=array();
	$stmt_login=$this->baglan->prepare("SELECT DISTINCT `CountryName` FROM `countries`");
	$stmt_login->execute();	
	$stmt_login->store_result();
	$stmt_login->bind_result($country);
	$numofrows=$stmt_login->num_rows;
	if($numofrows>0){
		while($stmt_login->fetch()){
			array_push($oneData, $country);
		}
	}
	$stmt_login->free_result();
	$stmt_login->close();
	return $oneData;
	}
	
	public function getCity($count){
	$oneData=array();
	$stmt_country=$this->baglan->prepare("SELECT  CountryID FROM `countries`WHERE `CountryName`=?");
	$stmt_country->bind_param("s", $count);
$stmt_country->execute();	
	$stmt_country->store_result();
	$stmt_country->bind_result($country);
	$numofrows=$stmt_country->num_rows;
	if($numofrows>0){
		$stmt_country->fetch();
		$stmt_login=$this->baglan->prepare("SELECT  `CityName` FROM `cities` WHERE CountryID=?");
		$stmt_login->bind_param("i", $country);
		$stmt_login->execute();	
		$stmt_login->store_result();
		$stmt_login->bind_result($city);
		$numofrows=$stmt_login->num_rows;
		if($numofrows>0){
			while($stmt_login->fetch()){
				array_push($oneData, $city);
			}
		}
		$stmt_login->free_result();
		$stmt_login->close();
	}
	$stmt_country->free_result();
	$stmt_country->close();
	return $oneData;
	}
	public function getCountity($city){
		$oneData=array();
			$stmt_login=$this->baglan->prepare("SELECT  `CityID` FROM `cities` WHERE `CityName`=?");
			$stmt_login->bind_param("s", $city);
			$stmt_login->execute();	
			$stmt_login->store_result();
			$stmt_login->bind_result($cityid);
			$numofrows=$stmt_login->num_rows;
			if($numofrows>0){
				$stmt_login->fetch();
				$stmt_city=$this->baglan->prepare("SELECT `CountyName` FROM `counties` WHERE `CityID`=?");
				$stmt_city->bind_param("i", $cityid);
				$stmt_city->execute();	
				$stmt_city->store_result();
				$stmt_city->bind_result($countty);
				$numofrows=$stmt_city->num_rows;
				if($numofrows>0){
					while($stmt_city->fetch()){
						array_push($oneData, $countty);
					}
				}
				$stmt_city->free_result();
				$stmt_city->close();
			}
			$stmt_login->free_result();
			$stmt_login->close();
		return $oneData;
	}
	public function checkUsername($user){
		$result=0;
		$stmt_login=$this->baglan->prepare("SELECT name FROM `users` WHERE `username`=?");
		$stmt_login->bind_param("s", $user);
		$stmt_login->execute();	
		$stmt_login->store_result();
		$stmt_login->bind_result($question);
		$numofrows=$stmt_login->num_rows;
		if($numofrows>0){
			$stmt_login->fetch();
			$result=1;
		}
		$stmt_login->free_result();
		$stmt_login->close();
		return $result;
	}
	public function securityQuestion(){
		$oneData=array();
		$stmt_login=$this->baglan->prepare("SELECT question FROM securityquestion");
		$stmt_login->execute();	
		$stmt_login->store_result();
		$stmt_login->bind_result($question);
		$numofrows=$stmt_login->num_rows;
		if($numofrows>0){
			while($stmt_login->fetch()){
				array_push($oneData, $question);
			}
		}
		$stmt_login->free_result();
		$stmt_login->close();
		return $oneData;
		
	}
	public function getRegistered($name, $lastname, $phone, $username, $email, $address, $postcode, $answer, $question, $birthday, $formuls, $country, $city, $countity, $pass1, $pass2, $checker){
		$oneData=array();
		if($pass1!=$pass2){
			$oneData['error']=true;
			$oneData['message']='Şifreler eşleşmiyor....';
		}
		else if($name==""||$lastname==""||$phone==""||$username==""||$email==""||$address==""||$postcode==""||$answer==""||$question==""||$birthday==""||$formuls==""||$country==""||$city==""||$countity==""||$pass1==""||$pass2==""){
			$oneData['error']=true;
			$oneData['message']='Lütfen Boş Alanları Doldurup Tekrar Deneyiniz.';	
		}
		else if($formuls==0){
			$oneData['error']=true;
			$oneData['message']='Formu tamamlayınız...';
		}
		else if($checker!=1){
			$oneData['error']=true;
			$oneData['message']='Kullanıcı Adı Kullanımda...';
		}
		else if($formuls==1 && $checker==1){
			$profile="unselected";
			$level=2;
			$stmt_login=$this->baglan->prepare("INSERT INTO `users`(`name`, `lastname`, `username`, `address`, `phone`, `email`, `postcode`, `country`, `city`, `profile`, `userpass`, `password`, `level`, question, answer) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$stmt_login->bind_param("ssssssisssssiss", $name, $lastname, $username, $address, $phone, $email, $postcode, $country, $city, $profile, $pass1, $pass2, $level, $question, $answer);
			$controller=$stmt_login->execute();	
			if($controller){
				$oneData['error']=false;
				$oneData['message']='login.html';
			}
			else {
				$oneData['error']=true;
				$oneData['message']='Kullanıcı Kaydı Şu Anda Gerçekleştirilemiyor....';}
			$stmt_login->free_result();
			$stmt_login->close();
		}
		return $oneData;
	}
	public function getPages($level){
		$oneData=array();
		$allData=array();
		$len=0;
		$stmt_login=$this->baglan->prepare("SELECT `name`, `link` FROM `pages` WHERE `level`=?");
		$stmt_login->bind_param("i", $level);
		$stmt_login->execute();	
		$stmt_login->store_result();
		$stmt_login->bind_result($bname, $blink);
		$numofrows=$stmt_login->num_rows;
		if($numofrows>0){
			while($stmt_login->fetch()){
				$oneData["navitem"]=$bname;
				$oneData["navlink"]=$blink;
				$len++;
				array_push($allData, $oneData);
			}
		}
		$stmt_login->free_result();
		$stmt_login->close();
		$allData['length']=$len;
		return $allData;
	}
	public function getUserInfoFromSESSION(){
		$oneData=array();
		$oneData['id']=$_SESSION['id'];
		$oneData["name"]=$_SESSION['username'];
		$oneData["lastname"]=$_SESSION['userlastname'];
		return $oneData;
	}
	public function cikisYap(){
		$_SESSION['id']=(-1);
		$_SESSION['username']=" ";
		$_SESSION['userlastname']=" ";
		$_SESSION['level']=0;
		$_SESSION['productid']=0;
	}
	public function fillUserInfo($user_id){
		$oneData=array();
		$stmt_login=$this->baglan->prepare("SELECT `name`, `lastname`, `username`, `address`, `phone`, `email`, `postcode`, `country`, `city`, `profile`,  `question`, `answer` FROM `users` WHERE id=?");
		$stmt_login->bind_param("i",$user_id);
		$stmt_login->execute();	
		$stmt_login->store_result();
		$stmt_login->bind_result($bname, $blastname, $busername, $baddress, $bphone, $bemail, $bpostcode, $bcountry, $bcity, $bprofile, $bquestion, $banswer);
		$numofrows=$stmt_login->num_rows;
		if($numofrows>0){
			$stmt_login->fetch();
			$oneData["name"]=$bname;
			$oneData["lastname"]=$blastname;
			$oneData["username"]=$busername;
			$oneData["address"]=$baddress;
			$oneData["phone"]=$bphone;
			$oneData["email"]=$bemail;
			$oneData["postcode"]=$bpostcode;
			$oneData["country"]=$bcountry;
			$oneData["city"]=$bcity;
			$oneData["profile"]=$bprofile;
			$oneData["question"]=$bquestion;
			$oneData["answer"]=$banswer;
		}
		$stmt_login->free_result();
		$stmt_login->close();
		return $oneData;
	}
	public function getProductsLink($id){
		$_SESSION['productid']=$id;
		return 'product.html';
	}
	public function getMyProducts(){
		$user=$_SESSION["id"];
		$oneData=array();
		$allData=array();

		$stmt_login=$this->baglan->prepare("SELECT  id, `productname`, `img1`, `price`, available FROM `products` WHERE seller=?");
		$stmt_login->bind_param("i", $user);
		$stmt_login->execute();	
		$stmt_login->store_result();
		$stmt_login->bind_result($bid, $bname, $bimg, $bprice, $available);
		$numofrows=$stmt_login->num_rows;
		if($numofrows>0){
			while($stmt_login->fetch()){
				$oneData['available']=$available;
				$oneData['name']=$bname;
				$oneData['productid']=$bid;
				$oneData['image']=$bimg;
				$oneData['price']=$bprice;
				array_push($allData, $oneData);
			}
		}
		$stmt_login->free_result();
		$stmt_login->close();
		return $allData;
	}
	public function showMyProduct($count){
		$_SESSION['productid']=$count;
		return 'myproduct.html';
	}
	public function getAllProducts(){
		if($_SESSION['level']>0){
			$user=$_SESSION['id'];
		}
		else{
			$user=0;
		}
		$oneData=array();
		$allData=array();
		$stmt_login=$this->baglan->prepare("SELECT  id, `productname`,  `seller`,  `img1`, `price` FROM `products` WHERE `available`=1");
		$control=$stmt_login->execute();	
		$stmt_login->store_result();
		$stmt_login->bind_result($bid, $bname, $bseller, $bimg, $bprice);
		$numofrows=$stmt_login->num_rows;
		if($numofrows>0){
			while($stmt_login->fetch()){
				if($bseller!=$user){
					$oneData['productid']=$bid;
					$oneData['name']=$bname;
					$oneData['seller']=$bseller;
					$oneData['image']=$bimg;
					$oneData['price']=$bprice;
					array_push($allData, $oneData);
				}
			}
		}
		$stmt_login->free_result();
		$stmt_login->close();
		return $allData;
	}
	public function getAllOrders(){
		$oneData=array();
		$stmt_login=$this->baglan->prepare("SELECT  id FROM level");
		$stmt_login->execute();	
		$stmt_login->store_result();
		$stmt_login->bind_result($bid);
		$numofrows=$stmt_login->num_rows;
		if($numofrows>0){
			while($stmt_login->fetch()){
				$array_push($oneData, $bid);
			}
		}
		$stmt_login->free_result();
		$stmt_login->close();
		return $oneData;		
	}
	public function savePage($id, $name, $link){
		$result=0;
		$stmt_login=$this->baglan->prepare("INSERT INTO `pages`( `name`, `link`, `level`) VALUES (?,?,?)");
		$stmt_login->bind_param("ssi", $name, $link, $id);
		$controller=$stmt_login->execute();	
		if($controller){
			$result=1;
		}
		$stmt_login->free_result();
		$stmt_login->close();
		return $result;
	}
	public function getAllUsers(){
		$allData=array();
		$oneData=array();
		$stmt_login=$this->baglan->prepare("SELECT id, `name`, `lastname`, `username`, `email`, (SELECT COUNT(*) FROM products WHERE seller=users.id ) AS sayi FROM `users`  ORDER BY sayi DESC");
		$stmt_login->execute();	
		$stmt_login->store_result();
		$stmt_login->bind_result($bid, $bname, $blastname, $busername, $bemail, $numberofproduct);
		$numofrows=$stmt_login->num_rows;
		if($numofrows>0){
			while($stmt_login->fetch()	){		$oneData["id"]=$bid;
			$oneData["name"]=$bname;
			$oneData["lastname"]=$blastname;
			$oneData["username"]=$busername;
			$oneData["email"]=$bemail;
			$oneData["urunsayisi"]=$numberofproduct;
			array_push($allData, $oneData);
		}}
		$stmt_login->free_result();
		$stmt_login->close();
		return $allData;
	}
	public function addProduct($productname, $files, $technic, $price){
		$seller=$_SESSION['id'];
		$saveddate = date("Y-m-d H:i:s");
		if($files==""||$files==null){
			$files="../img/noimage.png";
		}
		if($technic==""||$files==null){
			$technic="Gösterilecek birşey yok...";
		}
		if($price==0||$price=""||$price==null){
			$price="0";
		}
		$avi=1;
		$stmt_login=$this->baglan->prepare("INSERT INTO `products`( `productname`, `saveddate`, `seller`, `explanation`, `img1`,`price`, `available`) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt_login->bind_param("ssisssi", $productname, $saveddate, $seller, $technic, $files, $price, $avi);
		$controller=$stmt_login->execute();
		
		return $controller;
		if($controller){
			$stmt_login->free_result();
			$stmt_login->close();
			return 1;
		}
		$stmt_login->free_result();
		$stmt_login->close();
		return 0;
	}
	public function productAdder(){
		
		
	}
	public function fillproducts(){
		
		
	}
 }
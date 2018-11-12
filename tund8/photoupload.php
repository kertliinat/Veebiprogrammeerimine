<?php
  require("functions.php");
  //kui pole sisselogitud
  if(!isset($_SESSION["userId"])){
	  header("Location: index_3.php");
	  exit();
  }
  //väljalogimine
  if(isset($_GET["logout"])) {
	  session_destroy();
	  header("Location:index_3.php");
	  exit();
  }
  
  //pildi üleslaadimise osa
	$target_dir = "../picuploads/";
	//var_dump($_FILES);
	$target_file = "";
	
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
function resizeImage($image, $ow, $oh, $w, $h){
$newImage = imagecreatetruecolor($w, $h);
imagecopyresampled($newImage, $image, 0, 0, 0, 0, $w, $h, $ow, $oh);
return $newImage;
}
	
	
	//kas vajutati submit nuppu
	if(isset($_POST["submitPic"])) {
		//kas failinimi ka olemas on
		if(!empty($_FILES["fileToUpload"]["name"])){
		
		//määrame faili nime
		//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],
		PATHINFO_EXTENSION));
		//ajatempel
		$timeStamp = microtime(1) * 10000;
		//echo $timeStamp
		//$target_file = $target_dir .basename(basename($_FILES["fileToUpload"]["name"])) . "_" .$timeStamp ."." .$imageFileType;
		$target_file = $target_dir ."vp_".$timeStamp ."." .$imageFileType;
		
		
		
		//kas on pilt, küsin pildi suuruse küsimise kaudu
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "Fail on pilt - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "Fail ei ole pilt.";
			$uploadOk = 0;
		}
	//Faili suurus
	if ($_FILES["fileToUpload"]["size"] > 2500000) {
		echo "Kahjuks on fail liiga suur.";
		$uploadOk = 0;
	}
	//Kindlad failitüübid
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Kahjuks on lubatud ainult JPG, JPEG, PNG & GIF failid.";
		$uploadOk = 0;
	}
	//Kas fail on juba olemas
	if (file_exists($target_file)) {
		echo "Kahjuks on selline pilt juba olemas.";
		$uploadOk = 0;
	}
	
	}// kas on submit nuppu vajutatud
	
	
	
	//Kui on tekkinud viga
	if ($uploadOk == 0) {
		echo "Faili ei laetud üles!";
	//kui kõik on korras, laeme üles
	} else {
		//sõltuvalt failitüübist loome pildiobjekti
		if($imageFileType == "jpg" or $imageFileType == "jpeg") {
			$myTempImage = imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);
		}
		if($imageFileType == "png"){
			$myTempImage = imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);
		}
		if($imageFileType == "gif"){
			$myTempImage = imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);
		}
		
		//vaatame pildi originaalsuuruse
		$imageWidth = imagesx($myTempImage);
		$imageHeight = imagesx($myTempImage);
		//leian vajaliku suurendusfaktori
		if ($imageWidth > $imageHeight) {
			$sizeRatio = $imageWidth / 600;
		} else {
			$sizeRatio = $imageHeight /400;
		}
		
		$newWidth = round($imageWidth / $sizeRatio);
		$newHeight = round($imageHeight / $sizeRatio);
		$myImage = resizeImage($myTempImage, $imageWidth, $imageHeight, $newHeight, $newWidth);
		//muudetud suurusega pilt kirjutatakse pildifailiks
		if($imageFileType == "jpg" or $imageFileType == "jpeg") {
			if(imagejpeg($myImage, $target_file, 90)) {
				echo "Korras!";
			}else {
				echo "Pahasti!";
		}
		//imagepng($myImage, $target_file, 6)
		//imagegif($myImage, $target_file)
		imagedestroy($myTempImage);
		imagedestroy($myImage);
		
		
/*		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "Fail ". basename( $_FILES["fileToUpload"]["name"]). " on üles laetud!";
		} else {
			echo "Faili üleslaadimisel tekkis viga.";
		}*/
	}
	}
 
	  
  }
	
  //lehe päise üleslaadimise osa
  require("header.php");
  $pageTitle = "Fotode üleslaadimine";
  
?>


	<p>See leht on valminud <a href="http://www.tlu.ee" target="_blank">TLÜ</a> õppetöö raames ja ei oma mingisugust, mõtestatud või muul moel väärtuslikku sisu.</p>
	<hr>
	<p><b><a href="?logout=1">Logi välja</a></b></p>
	<p><b><a href="main.php">Tagasi pealehele</a></b></p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
    <label>Vali pilt mida üles laadida: </label>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submitPic">
</form>

  </body>
</html>
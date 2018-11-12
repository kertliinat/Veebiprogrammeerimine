<?php
class Photoupload {
	private $tempName;
	private $imageFileType;
	private $myTempImage;
	private $myImage;

	function __construct($tmpPic, $type){
		$this->tempName = $tmpPic ;
		$this->imageFileType = $type;
		$this->createImageFromFile();
	}
	
	//destructor, mis käivitub klassi eemaldamisel
	function __destruct(){
		
	}
	
	
	private function createImageFromFile(){
		//sõltuvalt failitüübist loome pildiobjekti
		if($this->imageFileType == "jpg" or $this->imageFileType == "jpeg") {
			$this->myTempImage = imagecreatefromjpeg($this->tempName);
		}
		if($this->imageFileType == "png"){
			$this->myTempImage = imagecreatefrompng($this->tempName);
		}
		if($this->imageFileType == "gif"){
			$this->myTempImage = imagecreatefromgif($this->tempName);
		
		}
	}

	public function resizeImage($width, $height){
		$this->createImageFromFile();
		//vaatame pildi originaalsuuruse
		$imageWidth = imagesx($this->myTempImage);
		$imageHeight = imagesy($this->myTempImage);
		//leian vajaliku suurendusfaktori
		if ($imageWidth > $imageHeight) {
			$sizeRatio = $imageWidth / $width;
		} else {
			$sizeRatio = $imageHeight / $height;
		}
		
		$newWidth = round($imageWidth / $sizeRatio);
		$newHeight = round($imageHeight / $sizeRatio);
		$this->myImage = $this->changePicSize($this->myTempImage, $imageWidth, $imageHeight, $newWidth, $newHeight);
	}
	
	private function changePicSize($image, $ow, $oh, $w, $h){
		$newImage = imagecreatetruecolor($w, $h);
		imagecopyresampled($newImage, $image, 0, 0, 0, 0, $w, $h, $ow, $oh);
		return $newImage;
	}
	
	public function addWatermark(){
		$waterMark = imagecreatefrompng("../vp_picfiles/vp_logo_color_w100_overlay.png");
		$waterMarkWidth = imagesx($waterMark);
		$waterMarkHeight = imagesy($waterMark);
		$waterMarkPosX = imagesx($this->myImage) - $waterMarkWidth - 10;
		$waterMarkPosY = imagesy($this->myImage) - $waterMarkHeight  - 10;
		//kopeerin vesimärgi pikslid pildile
		imagecopy($this->myImage, $waterMark, $waterMarkPosX, $waterMarkPosY, 0, 0, $waterMarkWidth, $waterMarkHeight);
	}
	
	public function addText (){
		//lisame ka teksti
		$textToImage =  "Veebiprogrammeerimine";
		$textColor = imagecolorallocatealpha($this->myImage, 255, 255, 255, 60);
		//alpha 0..127
		imagettftext($this->myImage, 20, -45, 10, 25, $textColor, "../vp_picfiles/ARIALBD.TTF", $textToImage);
	}
	
		
	public function savePhoto($targetFile){
		$notice = "";
		//muudetud suurusega pilt kirjutatakse pildifailiks
		if($this->imageFileType == "jpg" or $imageFileType == "jpeg") {
			if(imagejpeg($this->myImage, $targetFile, 90)) {
				$notice = 1;
				//kui pilt salvestati siis lisame andmebaasi
				//addPhotoData($target_file_name, $_POST["altText"], $_POST["privacy"]);
			}else {
				$notice = 0;
				//echo "Pahasti!";
		}
		}
		if($this->imageFileType == "png") {
			if(imagepng($this->myImage, $targetFile, 6)) {
				echo "Korras!";
			}else {
				$notice = 0;
		}
		}
		if($this->imageFileType == "gif") {
			if(imagegif($this->myImage, $target_file)) {
				echo "Korras!";
			}else {
				$notice = 0;
		}
		}
		//imagepng($myImage, $target_file, 6)
		//imagegif($myImage, $target_file)
		imagedestroy($this->myTempImage);
		imagedestroy($this->myImage);
		
		
		
		
		
		
		
	}
	
	
	
	
	
	
}//class lõppeb
?>
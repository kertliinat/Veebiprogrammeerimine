<?php
	//echo "Siin on minu esimene PHP!" ; 
	require("functions.php");
	$name = "";
	$surname = "";
	$email = "";
	$gender = "";
	$birthMonth = null;
	$birthYear = null;
	$birthDay = null;
	$birthDate = null;
	$monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni","juuli", "august", "september", "oktoober", "november", "detsember"];
	//hetkese kuu arvväärtus
	$monthNow = date ("m");
	
  $nameError = "";
  $surnameError = "";
  $birthMonthError = "";
  $birthYearError = "";
  $birthDayError = "";
  $genderError = "";
  $emailError = "";
  $passwordError = "";
	//Muutujad võimalike veateadetega
	
	
	//kui on uue kasutaja loomise nuppu vajutatud
	if (isset($_POST["submitUserData"])){
	if (isset($_POST["firstName"]) and !empty($_POST["firstName"])){
		$name = $_POST["firstName"];
		//$name = test_input($_POST["name"]);
		
	} else {
		$nameError = "Palun sisesta eesnimi!";
	}
	
	
	if (isset($_POST["surname"]) and !empty($_POST["surname"])){
		//$surname = $_POST["surName"];
		$surname = test_input($_POST["surname"]);
	}else {$surnameError = "Palun sisesta perekonnanimi";
	
	}
	if (isset($_POST["gender"])){
		$gender = intval($_POST["gender"]);
	} else {
		$genderError= "Palun märgi sugu!";
	}
	//kontrollime kas sünniaeg sisestati ja kas on korrektne
	if(isset($_POST["birthDay"])) {
		$birthDay = $_POST["birthDay"];
	}
	
	if(isset($_POST["birthMonth"])) {
		$birthMonth = $_POST["birthMonth"];
	}
	
	if(isset($_POST["birthYear"])) {
		$birthYear = $_POST["birthYear"];
	}
	if (isset($_POST["email"]) and !empty($_POST["email"])) {
		//$email = test_input($_POST["email"]);
		$email = $_POST["email"];
	}else{$emailError = "Palun sisesta e-maili aadress";}
	
  if (!isset($_POST["password"]) or empty($_POST["password"])){
	$passwordError = "Palun sisesta salasõna!";
  } else {
	  if(strlen($_POST["password"]) < 8){
		  $passwordError = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["password"]) ." märki).";
	  }
  }
	
	
	if(isset($_POST["birthDay"]) and !empty($_POST["birthDay"])) {
		
	}else {
		$birthDayError = "Palun sisesta enda sünnipäev";
	}
	  //kontrollime, kas sünniaeg sisestati ja kas on korrektne
  if(isset($_POST["birthDay"]) and !empty($_POST["birthDay"])){
	  $birthDay = intval($_POST["birthDay"]);
  } else {
	  $birthDayError = " Palun vali sünnikuupäev!";
  }
  
  if(isset($_POST["birthMonth"]) and !empty($_POST["birthMonth"])){
	  $birthMonth = intval($_POST["birthMonth"]);
  } else {
	  $birthMonthError = " Palun vali sünnikuu!";
  }
  
  if(isset($_POST["birthYear"]) and !empty($_POST["birthYear"])){
	  $birthYear = intval($_POST["birthYear"]);
  } else {
	  $birthYearError = " Palun vali sünniaasta!";
  }
		
	//kontrollin kuupäeva õigsust
	if(isset($_POST["birthDay"]) and isset($_POST["birthMonth"]) and isset($_POST["birthYear"])){
		//checkdate(päev, kuu, aasta)
		if(checkdate(intval($_POST["birthMonth"]),intval($_POST["birthDay"]),intval($_POST["birthYear"]))){
			$birthDate = date_create($_POST["birthMonth"] ."/" .$_POST["birthDay"] . "/" .$_POST["birthYear"]);
			$birthDate = date_format($birthDate, "Y-m-d");
			//echo "kuupäev tuli:", $birthDate;
		}
		} else {
		$birthYearError = " kuupäev on vigane!";
	}	
	if(empty($nameError) and empty($surnameError) and empty($birthDayError) and empty($birthYearError) and empty($birthMonthError) and empty($genderError)and empty($emailError)and empty($passwordError)) {
		$notice = signup($name, $surname, $email, $gender, $birthDate, $_POST["password"]);
		echo $notice;
	
	} 
}//kui on nuppu vajutatud = lõppeb 
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Katselise veebi uue kasutaja loomine</title>
  
</head>
<body>
	<h1>
	</h1>
	<p>Siin on <a href="http://www.tlu.ee" target="_blank"> TLÜ</a> õppetöö raames valminud veebilehed.
	Lisasin selle lause kodutöö raames.
	Need ei oma mingit sügavat sisu ja nende kopeerimine ei oma mõtet.</p>
	<hr>
	
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label>Eesnimi:</label><br>
		<input name= "firstName" type = "text" value=""><span><?php echo $nameError;?></span><br> 
		<label>Perekonnanimi:</label><br>
		<input name= "surname" type = "text" value="<?php echo $name; ?>"><span><?php echo $surnameError;?></span><br>
		
	<input type="radio" name="gender" value="2"<?php if($gender == "2") {echo "checked";}?>><label>Naine</label>
	<input type="radio" name="gender" value="1"<?php if($gender == "1") {echo "checked";}?>><label>Mees</label><br>
	<span><?php echo $genderError; ?></span> <br>
		<label>Sünnipäev: </label>
	  <?php
	    echo '<select name="birthDay">' ."\n";
		echo '<option value="" selected disabled>päev</option>'."\n";
		for ($i = 1; $i < 32; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthDay){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
	  ?>
		 <label>Sünnikuu: </label>
	  <?php
	    echo '<select name="birthMonth">' ."\n";
		echo '<option value="" selected disabled>kuu</option>'."\n";
		for ($i = 01; $i < 13; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthMonth){
				echo " selected ";
			}
			echo ">" .$monthNamesET[$i - 1] ."</option> \n";
		}
		echo "</select> \n";
	  ?>

	<label>Sünniaasta: </label>
	  <?php
	    echo '<select name="birthYear">' ."\n";
		echo '<option value="" selected disabled>aasta</option>'."\n";
		for ($i = date("Y") -15; $i >= date("Y") - 100; $i --){
			echo '<option value="' .$i .'"';
			if ($i == $birthYear){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
		echo $birthDayError. $birthMonthError. $birthYearError;
	  ?>
	  
	  <br>
	<label>E-mail (kasutajatunnus):</label><br>
		<input type = "email" name="email"><span><?php echo $emailError;?></span><br> 
	  
	<label>Salasõna:</label><br>
		<input name= "password" type = "password"><span><?php echo $passwordError;?></span><br> 
		<input name="submitUserData" type="submit" value="Loo kasutaja">
	</form>
	

	<p><a href="index_3.php">Logi oma tuliuue kasutajaga sisse!</a></p>
</body>
</html>
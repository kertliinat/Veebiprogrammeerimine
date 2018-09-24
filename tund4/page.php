<?php
	//echo "Siin on minu esimene PHP!" ; 
	$name = "Tundmatu";
	$surname = "Inimene";
	$fullName = $name ." " .$surname;
	$monthNow = date ("m");
	//hetkese kuu arvväärtus
	
	//var_dump($_POST);
	if (isset($_POST["firstName"])){
		//demoks üks funktsioon
		$fullName = fullName();
		//$name = $_POST["firstName"];
		$name = test_input($_POST["firstName"]);
	}
	if (isset($_POST["surName"])){
		//$surname = $_POST["surName"];
		$surname = test_input($_POST["surName"]);
	}
function test_input($data) {
	//echo "Koristan! \n";
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function fullName() {
	$GLOBALS["fullName"] = $GLOBALS["name"] . " " .$GLOBALS["surname"];
	//echo $fullName;
}
	
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title> 
	<?php
		echo $name;
		echo " ";
		echo $surname;
	?>
  , Õpilane </title>
  
</head>
<body>
	<h1>
	<?php
		echo $name . " " . $surname;
		//echo $monthNow;
	
	?>
	</h1>
	<p>Siin on <a href="http://www.tlu.ee" target="_blank"> TLÜ</a> õppetöö raames valminud veebilehed.
	Lisasin selle lause kodutöö raames.
	Need ei oma mingit sügavat sisu ja nende kopeerimine ei oma mõtet.</p>
	<hr>
	
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label>Eesnimi:</label>
		<input name= "firstName" type = "text" value="">
		<label>Perekonnanimi:</label>
		<input name= "surName" type = "text" value="">
		<label>Sünniaasta</label>
		<input name="birthYear" type="number" min="1914" max="2003" value="1999">
		<label>Sünnikuu</label>
		<?php
		if ($monthNow == "option value"){
		echo "selected";}
		
		
		?>
		<select name="birthMonth">
			<option value= "<?php echo $monthNow ?>" selected> <?php
	if ($monthNow == "01"){
		echo ("--Jaanuar--");
	} elseif ($monthNow == "02") {
		echo ("--Veebruar--");
	} elseif ($monthNow == "03") {
		echo ("--Märts--");
	}elseif ($monthNow == "04") {
		echo ("--Aprill--");
	}elseif ($monthNow == "05") {
		echo ("--Mai--");
	}elseif ($monthNow == "06") {
		echo ("--Juuni--");
	}elseif ($monthNow == "07") {
		echo ("--Juuli--");
	}elseif ($monthNow == "08") {
		echo ("--August--");
	}elseif ($monthNow == "09") {
		echo ("--September--");
	}elseif ($monthNow == "10"){
		echo ("--Oktoober--");
	}elseif ($monthNow == "11"){
		echo ("--November--");
	}elseif ($monthNow == "12"){
		echo ("--Detsember--");
	} ?> </option>
			<option value="01"> Jaanuar</option>
			<option value="02"> Veebruar</option>
			<option value="03"> Märts</option>
			<option value="04"> Aprill</option>
			<option value="05"> Mai</option>
			<option value="06"> Juuni</option>
			<option value="07"> Juuli</option>
			<option value="08"> August</option>
			<option value="09"> September</option>
			<option value="10"> Oktoober</option>
			<option value="11"> November</option>
			<option value="12"> Detsember</option>
		<br>
		<input name="" type="submit" value="Saada andmed">
	</form>
	
<?php
	if (isset($_POST["firstName"])) {
		fullName();
	echo "<br><p>" .$fullName . ". Olete elanud järgnevatel aastatel: </p>";
	echo "<ol> \n";
	for ($i = $_POST["birthYear"]; $i <= date("Y"); $i ++) {
	echo "<li>" .$i. "</li> \n";
		}
		
	echo "</ol> \n";
		}
?>

</body>
</html>
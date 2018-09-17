<?php
	//echo "Siin on minu esimene PHP!" ; 
	$name = "Tundmatu";
	$surname = "Inimene";
	
	//var_dump($_POST);
	if (isset($_POST["firstName"])){
		$name = $_POST["firstName"];
	}
	
	if (isset($_POST["surName"])){
		$surname = $_POST["surName"];
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
	?>
	</h1>
	<p>Siin on <a href="http://www.tlu.ee" target="_blank"> TLÜ</a> õppetöö raames valminud veebilehed.
	Lisasin selle lause kodutöö raames.
	Need ei oma mingit sügavat sisu ja nende kopeerimine ei oma mõtet.</p>
	<hr>
	
	<form method="POST">
		<label>Eesnimi:</label>
		<input name= "firstName" type = "text" value="">
		<label>Perekonnanimi:</label>
		<input name= "surName" type = "text" value="">
		<label>Sünniaasta</label>
		<input name="birthYear" type="number" min="1914" max="2003" value="1999">
		<br>
		<input name="" type="submit" value="Saada andmed">
	</form>
	
	<?php
		if (isset($_POST["firstName"])) {
		echo "<br><p> Olete elanud järgnevatel aastatel: </p>";
		echo "<ol> \n";
		for ($i = $_POST["birthYear"]; $i <= date("Y"); $i ++) {
			echo "<li>" .$i. "</li> \n";
		}
		
		echo "</ol> \n";
		}
	?>

</body>
</html>
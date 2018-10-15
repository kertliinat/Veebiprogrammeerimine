<?php
	//require("functions.php");
	


?>
<!DOCTYPE html>
<meta charset="utf-8">
<form method="POST">
<label>Kiisu nimi:</label>
	<input name="catName" type="text" value="">
<label>Kiisu värvus:</label>
	<input name="catColor" type="text" value="">
<label>Kiisu saba pikkus:</label>
	<input name="tailLength" type="text" value="">
<br>
	<input name="submitUserData" type="submit" value="Saada andmed">
<?php
	if (!empty($_POST["catName"]))
		//ei saanud millegiärast 'and' fx tööle
	{
		echo "<p> Andmed vastu võetud!</p>";
	}
	if (empty($_POST["catName"])) 
	{
		echo "<p> Te ei ole sisestanud kiisu nime!</p>";
	}

?>
</form>

<?php
	if (isset($_POST["catName"]))
	{ echo "<br><p> Hetkeseisuga on kiisude loend vastav: </p>";
	echo "<ol> \n";
	$i = $_POST["catName"];
	$j = $_POST["catColor"];
	$k = $_POST["tailLength"];
	echo "<li>" .$i." " .$j." " .$k. "</li> \n";
	
	echo "</ol> \n";
		

		
	}

?>

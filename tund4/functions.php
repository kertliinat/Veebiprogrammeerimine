<?php
require("../../../config.php");
//echo $GLOBALS["serverHost"];
//echo $GLOBALS["serverUsername"];
//echo $GLOBALS["serverPassword"];
$database = "if18_rinde";
function addcat($catName, $catColor, $tailLength){
	//loon ühenduse
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"],);
	//käsk mis kirjutab andmed andmebaasi kasside tabelisse
	$stmt = $mysqli->prepare("SELECT kassinimelahter, kassivärvilahter, kassisabapikkuselahter FROM kiisud, INSERT INTO kiisud (kassinimelahter, kassivärvilahter, kassisabapikkuselahter) VALUES(?,?,?)");
	//käsk mis määrab andmete tüübid
	$stmt->bind_param("ssi", $catName, $catColor,  $tailLength);
	//
	//püüan andmed kinni
	$stmt->bind_result($readCatName, $readCatColor, $readTailLength);
	
	$stmt->close();
	$mysqli->close();
	return 
}

function saveAMsg($msg) {
	//echo "Töötab!";
	$notice = ""; //see on teade, mis antakse salvestamise kohta 
	//loome ühenduse andmebaasiserveriga
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	//valmistame ette SQL päringu
	$stmt = $mysqli->prepare("INSERT INTO vpamsg (message) VALUES(?)");
	echo $mysqli->error;
	$stmt->bind_param("s", $msg); //s - string, i - integer, d - decimal
	if ($stmt->execute()) {
		$notice = 'Sõnum: "' .$msg .'" on salvestatud!';
	} else {
		$notice = "Sõnumi salvestamisel tekkis tõrge: " .$stmt-> error;
	}
	$stmt->close();
	$mysqli->close();
	return $notice;
}
?>
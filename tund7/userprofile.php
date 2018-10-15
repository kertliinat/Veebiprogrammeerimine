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
  $mydescription = "Pole iseloomustust lisanud.";
  $mybgcolor = "#FFFFFF";
  $mytxtcolor = "#000000";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<style>
	<?php
	echo"body{background-color: ". $mybgcolor. "; \n";
	echo "color: " .$mytxtcolor ."} \n" ; 
	?>
	</style>
	<title>
	  <?php
	    echo $_SESSION["userFirstName"];
		echo " ";
		echo $_SESSION["userLastName"];
	  ?>
	</title>
  </head>
  <body>
    <h1>Kasutajaprofiil</h1>
	<p>See leht on valminud <a href="http://www.tlu.ee" target="_blank">TLÜ</a> õppetöö raames ja ei oma mingisugust, mõtestatud või muul moel väärtuslikku sisu.</p>
	<hr>
	<p> Olete sisse loginud nimega: <?php echo $_SESSION["userFirstName"]. " " .$_SESSION["userLastName"]; ?>. <b><a href="?logout=1">Logi välja</a></b></p>
	<ul>
	  <li> <a href="main.php">Tagasi koju</a></li>
	</ul>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label>Minu tutvustus: </label><br>
		<textarea rows="10" cols="80" name="description"><?php echo $mydescription; ?></textarea>
		<br>
		<label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $mybgcolor; ?>"><br>
		<label>Minu valitud tekstivärv: </label><input name="bgcolor" type="color" value="<?php echo $mytxtcolor; ?>"><br>
		<input name="submitProfile" type="submit" value="Salvesta">
		
  </body>
</html>
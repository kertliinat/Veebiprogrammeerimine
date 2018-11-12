<?php
  require("functions.php");
  require("header.php");
    //kui pole sisselogitud
  if(!isset($_SESSION["userId"])){
	  header("Location: index.php");
	  exit();
  }

  
   //väljalogimine
  if(isset($_GET["logout"])) {
	  session_destroy();
	  header("Location:index_3.php");
	  exit();
  }
	$notice = allusers();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registreeritud kasutajad</title>
  <style>
	  <?php
        echo "body{background-color: " .$_SESSION["bgColor"] ."; \n";
		echo "color: " .$_SESSION["txtColor"] ."} \n";
	  ?>
	</style>
</head>
<body>
  <h1>Kasutajad</h1>
  <p>Siin on minu <a href="http://www.tlu.ee">TLÜ</a> õppetöö raames valminud veebilehed. Need ei oma mingit sügavat sisu ja nende kopeerimine ei oma mõtet.</p>
  <hr>
  <p>Kasutajad siin lehel: <br> <?php echo $notice; ?> </p>
  
	<p><a href="validatemsg.php">Tagasi</a> sõnumite lehele!</p> <br>
	<b><a href="?logout=1">Logi välja</a></b>
	
  
 
 

</body>
</html>

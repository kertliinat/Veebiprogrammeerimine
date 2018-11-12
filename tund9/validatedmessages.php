<?php
  require("functions.php");
  //kui pole sisse loginud
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
  
  $messagesByUser = readallvalidatedmessagesbyuser();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Valideeritud anonüümsed sõnumid</title>
  <style>
	  <?php
        echo "body{background-color: " .$_SESSION["bgColor"] ."; \n";
		echo "color: " .$_SESSION["txtColor"] ."} \n";
	  ?>
	</style>
</head>
<body>
  <h1>Valideeritud sõnumid valideerijate kaupa</h1>
  <p>Siin on minu <a href="http://www.tlu.ee">TLÜ</a> õppetöö raames valminud veebilehed. Need ei oma mingit sügavat sisu ja nende kopeerimine ei oma mõtet.</p>
  <hr>
  <ul>

  </ul>
  <hr>
  
  <?php echo $messagesByUser; ?>

</body>
</html>
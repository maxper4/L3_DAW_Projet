<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/Xml.php"); 
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/ValidateQuestion.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/coursehome.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/coursesInfo.php");

$isAdmin = isAdmin($_GET['idchapter']);
$isStudent = isInCourse($_GET["idchapter"]);

$choice1 = $_GET['choice1'];
$choice2 = $_GET['choice2'];
$choice3 = $_GET['choice3'];
$choice4 = $_GET['choice4'];

$id = $_GET["idchapter"];
$ques = $_GET["question"];
$Difficulty = $_GET["difficulté"];
$isok=true;
$Answer = $_GET["answer"];

addQuestion($id,$ques,$Difficulty,$isok,$Answer,$choice1,$choice2,$choice3,$choice4);


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning</title>
    
    <!-- CSS -->
	  <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/darkMode.css" />
    <link rel="stylesheet" href="../css/shared.css" />
  </head>
  <body>
	      <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");?>
        <div><?php echo getTranslation(124)?></div>
        <a style="color:black" href="addQuestion?id=<?php echo $id; ?>"><?php echo getTranslation(121)?></a>
        </br>
        <a style="color:black" href="coursehome?id=<?php echo $id; ?>"><?php echo getTranslation(120)?></a>
        <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/footer.php"); ?>
    </body>
    <script src="../../../../shared/js/jquery.js"></script>
        <script src="../js/shared.js"></script>
</html>

<?php

session_start();
$_SESSION["uid"] = uniqid();
$_SESSION["id"] = 1;
$_SESSION["response"] = array();
?>
<!DOCTYPE HTML>
<html>
	<head>
	<link rel = "stylesheet" type="tex/css" href="dist/css/bootstrap.css"/>
	<link rel = "stylesheet" type="tex/css" href="style.css"/>
	</head>
	<body>
	<h1>Welcome to Survey on role of golden ration in beauty</h1>
	<a href="survey.php"><span class = "glyphicon glyphicon-circle-arrow-right" id = "start"></span></a>

	</body>
</html>
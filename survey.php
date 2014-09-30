<?php
require_once "constants.php";
//require_once "init.php";
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
session_start();
if(!isset($_SESSION["uid"])){
	header('location:index.php');
}
//echo getLimits();
$db = mysqli_connect($url,$db_user,$db_pass,$db_name) or die('error connecting to server');
if(isset($_GET["id"]))
{
	if (!filter_var($_GET["choice"], FILTER_VALIDATE_INT)) {
		die('response not proper');
	}
	if($_GET["id"]>$FACE_COUNT){
		$_SESSION["id"] = $_GET["id"];
		$_SESSION["response"][$_SESSION["id"]-1] = $_GET["choice"];
		
		header('location:submit.php');
	}
	else{
	$_SESSION["id"] = $_GET["id"];
	$_SESSION["response"][$_SESSION["id"]-1] = $_GET["choice"];
	//echo $_SESSION["response"][$_SESSION["id"]-1];
	//$type = "John O'Hara";
	//echo mysql_real_escape_string($type);
}
}
$query = "SELECT * FROM face WHERE face_id= ".$_SESSION["id"];

$result = mysqli_query($db,$query);
$array = mysqli_fetch_array($result);
//echo $array["url"];
mysqli_close($db);
?>
<!DOCTYPE html>
<html>
	<head>

	<link rel = "stylesheet" type="text/css" href="style.css"/>
	
	</head>
	<body>
	<h1>Rate the celebrity on the basis of beauty</h1>
	<div class = "face">
		<img src = "<?php echo $array["url"];?>" class="faceimg">
	</div>
	<form name="submit_choice" method="get" action="survey.php">
		<div class="response">
			<div class="row">
				<div class="radio"><input type="radio" name="choice" value="1"/>1</div>
				<div class="radio"><input type="radio" name="choice" value="2"/>2</div>
				<div class="radio"><input type="radio" name="choice" value="3" checked/>3</div>
				<div class="radio"><input type="radio" name="choice" value="4"/>4</div>
				<div class="radio"><input type="radio" name="choice" value="5"/>5</div>

			</div>
			<input type="hidden" name="id" value = "<?php echo $_SESSION["id"]+1?>"/>
			
			<input type = "submit" class="next" value="next">
		</div>

	</form>
	</body>
</html>
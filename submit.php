<?php
require_once "constants.php";
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
session_start();
if(!isset($_SESSION["uid"])){
	header('location:index.php');
}
//echo $_SESSION["uid"];
$submit = false;
if(isset($_POST["submit"])){
	$res = $_SESSION["response"];
	$db = mysqli_connect($url,$db_user,$db_pass,$db_name) or die('error connecting to server');
	$query = "INSERT INTO `users` (`f1`,`f2`,`f3`,`f4`,`f5`,`f6`,`f7`,`f8`) VALUES ('$res[1]','$res[2]','$res[3]','$res[4]','$res[5]','$res[6]','$res[7]','$res[8]')";
	$result = mysqli_query($db,$query);
	if(!$result){
		echo mysqli_error($db);
		mysqli_close($db);
	}
	/*else{
	session_destroy();
	mysqli_close($db);
	header('location:index.php');}*/

}
?>
<!DOCTYPE html>
<html>
<head>
<script src="jquery-1.11.1.min.js"></script>
<script src="graph.js"></script> 
<link rel = "stylesheet" type="text/css" href="style.css"/>
</head>
<body>
	<?php if(!isset($_POST["submit"]))
	{?>
	<h2>Are you sure you want to submit?</h2>
	<form action="submit.php" name="submit_response" method="post">
		<input type = "submit" value = "submit" name="submit"/>
	</form>
	<!--Data visualization begins-->

	<?php 
	}
		else//(isset($_POST["submit"]))
		{
			$res = array();
			$names = array();
			for($x = 0;$x<$FACE_COUNT;$x++)
			{
				$res[$x] = 0;
			}
			$db = mysqli_connect($url,$db_user,$db_pass,$db_name) or die('error connecting to server');
			$query = "SELECT * FROM users";

			$result = mysqli_query($db,$query);
			//Data for first graph for user response
			//$array = mysqli_fetch_array($result);
			$total = 0;
			while($row = mysqli_fetch_array($result))
			{
				$res[0] += $row['f1'];
				$res[1] += $row['f2'];
				$res[2] += $row['f3'];
				$res[3] += $row['f4'];
				$res[4] += $row['f5'];
				$res[5] += $row['f6'];
				$res[6] += $row['f7'];
				$res[7] += $row['f8'];
				$total++;
			}
			for($x = 0;$x < $FACE_COUNT;$x++)
			{
					$res[$x] /= $total;
					$res[$x] = round($res[$x],2);
					//echo $res[$x];
			}
			$ratios = array();//array to store ratios of individual pictures,indexed with face id
			$query = "SELECT * FROM faceratio";
			$result = mysqli_query($db,$query);
			for($x = 1;$x<=$FACE_COUNT;$x++)
			{
				$ratios[$x] = array();
			}
			while($row = mysqli_fetch_array($result))
			{
				$ratios[$row['face_id']][$row['ratio_id']-1] = round((($GOLDEN_RATIO-abs($GOLDEN_RATIO-$row['ratio_val']))/$GOLDEN_RATIO)*100);
			}
			//for storing names indexed by id's
			$query = "SELECT name FROM face";
			$result = mysqli_query($db,$query);
			$i = 1;
			while($row = mysqli_fetch_array($result))
			{
				$names[$i] = $row['name'];
				$i++; 
			}
			mysqli_close($db);
	 ?>
	<div class="chartwrap">
	<h2>What people say</h2>
	<div class="chart">
    
	</div></div>
	<div class="data">
	<h2>What data says</h2>
	<?php
		for($x = 1;$x<=$FACE_COUNT;$x++)
		{
			?>

			<!--Dynamic html ratio charts-->
			<div class="ratiochartwrap">
			<h3><?php echo $names[$x] ?></h3>
			<div class="ratiochart" id="r<?php echo $x?>">
    
			</div></div>
			<?php
		}
	?></div>
	<div class="ratiodesc">
	<h3>Ratios used in our survey relative to golden ratio = 1.618</h3>
		<div class="row">
		#1 => Eyes to nose flair to nose base
		</div>
		<div class="row">
		#2 => Eyes to nostril top to center of lips
		</div>
		<div class="row">
		#3 => Eyes to nose base to bottom of lips
		</div>
		<div class="row">
		#4 => Eyes to center of lips to bottom of chin
		</div>
		<div class="row">
		#5 => Nose flair to bottom of lips to bottom of chin
		</div>
		<div class="row">
		#6 => Nose flair to top of lips to bottom of chin
		</div>
		<div class="row">
		#7 => Arc of eyebrows to top of lips to bottom of chin
		</div>
		<div class="row">
		#8 => Side of face to center of face to outside of opposite eye
		</div>
	</div>
	<!--<script src="http://d3js.org/d3.v3.min.js"  charset="utf-8"></script>-->
	<script src="d3/d3.min.js"></script>
	<script>

	$(document).ready(function(){
		var data = [1.2,4.5,2.3,4.2,1.3];
		drawGraph(<?echo json_encode($res);?>,".chart");
		/*for(var x = 1;x<=8;x++)
		{
			drawRatioGraph(<?echo json_encode($ratios[x]);?>,("#r"+x));
		}
		*/
		drawRatioGraph(<?echo json_encode($ratios[1]);?>,"#r1");
		drawRatioGraph(<?echo json_encode($ratios[2]);?>,"#r2");
		drawRatioGraph(<?echo json_encode($ratios[3]);?>,"#r3");
		drawRatioGraph(<?echo json_encode($ratios[4]);?>,"#r4");
		drawRatioGraph(<?echo json_encode($ratios[5]);?>,"#r5");
		drawRatioGraph(<?echo json_encode($ratios[6]);?>,"#r6");
		drawRatioGraph(<?echo json_encode($ratios[7]);?>,"#r7");
		drawRatioGraph(<?echo json_encode($ratios[8]);?>,"#r8");
		/*var x = d3.scale.linear()
    .domain([0, d3.max(data)])
    .range([0, 500]);

    d3.select(".chart")
  .selectAll("div")
    .data(data)
  .enter().append("div")
    .style("width", function(d) { return x(d) + "px"; })
    .text(function(d) { return d; });*/


});
	</script><?php }
	
	 ?>
</body>
</html>
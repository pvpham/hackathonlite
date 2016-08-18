<?php
session_start();
include_once 'Dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: default.php");
}
$rand = rand(0,10000);
$found = mysql_query("SELECT COUNT(*) FROM cdata WHERE ctype = '' AND amount > '$rand' LIMIT 1");
$foundRow = mysql_fetch_array($found);

if($foundRow[0] < 1){
	$rand2 = rand(0,1000);
	$found = mysql_query("SELECT COUNT(*) FROM cdata WHERE ctype = '' AND amount > '$rand2' LIMIT 1");
	$foundRow = mysql_fetch_array($found);
	if($foundRow[0] < 1){
		$rand3 = rand(0,1000);
		$found = mysql_query("SELECT COUNT(*) FROM cdata WHERE ctype = '' AND amount > '$rand3' LIMIT 1");
		$foundRow = mysql_fetch_array($found);
		if($foundRow[0] < 1){
			$res = mysql_query("SELECT * FROM cdata WHERE ctype='' AND amount > '0' LIMIT 1");
			$row = mysql_fetch_array($res);
		}

		else{
			$res = mysql_query("SELECT * FROM cdata WHERE ctype='' AND amount > '$rand3' LIMIT 1");
			$row = mysql_fetch_array($res);
		}
	}
	else{
		$res = mysql_query("SELECT * FROM cdata WHERE ctype='' AND amount > '$rand2' LIMIT 1");
		$row = mysql_fetch_array($res);
	}
}
else{
	$res = mysql_query("SELECT * FROM cdata WHERE ctype='' AND amount > '$rand' LIMIT 1");
	$row = mysql_fetch_array($res);
}

if(isset($_POST['btn-categorize']))
{
	$comtype = mysql_real_escape_string($_POST['comtype']);
	$stype = mysql_real_escape_string($_POST['stype']);
	$name = $row['name'];
	$address = $row['address'];
	$state = $row['state'];
	$amount = $row['amount'];
	$date = $row['date'];

	if(mysql_query("UPDATE cdata SET ctype = '$comtype', stype = '$stype' WHERE name = '$name' AND address = '$address' AND state = '$state' AND amount = '$amount' AND date='$date' "))
	{
		?>
			<script>alert('Response sucessfully recorded!')</script>
		<?php
	}
	else{
		?>
			<script>alert('An error occurred, while recording your response.')</script>
		<?php
	}

}

?>

<html>
<head>
<title>Categorize Contriburions</title>
<style>
	
	html{
		background-image: url("finance.jpg");
		background-size: cover;
		background-repeat: no-repeat;
	}

	body{
		margin-top: 2cm;
		margin-left: 8cm;
		width: 700px;
		height: 500px;
		background-color: white;
		border-style: solid;
		border-color: black;
		box-shadow: 10px 10px 5px black;
	}

	h2{
		text-align: center;
		text-shadow: 4px 4px white;
		color:black;
		font-family: Arial;
		text-align: center;
		font-size: 36pt;
	}

	#current_contribution{
		text-align: center;
		text-indent: right;
	}

</style>
</head>
<body>
	<h2>Categorize this contribution</h2>
	<center>
		<div id="current_contribution">
			<?php
				echo "Name: ". $row['name'];
				echo "<br>";
				echo "Address: ". $row['address'];
				echo "<br>";
				echo "State: ". $row['state'];
				echo "<br>";
				echo "Amount: $". $row['amount'];
				echo "<br>";
				echo "Date: ". $row['date'];
				echo "<br>";
			?>
		</div>
	</center>
	<center>
		<br>
		<div id="categorize-form">
			<form method="post">
				<table align="center" border="0">
					<tr>
						<td>
							<p>Please select either Individual or Oraganization for the Committee type</p>
							<input type="radio" name="comtype" value="Individual" /checked>Individual<br>
							<input type="radio" name="comtype" value="Organization">Organization<br><br>
						</td>
					</tr>
					<tr>
						<td>
							<p>Please select either In-state or Out-of-state for the Committee's location</p>
							<input type="radio" name="stype" value="In-State"/checked>In-state<br>
							<input type="radio" name="stype" value="Out-Of-State">Out-of-state<br><br>
						</td>
					</tr>
					<tr>
						<td><button type="submit" name="btn-categorize">Categorize and next</button></td>
					</tr>
				</table>
			</form>
		</div>
		<a id ="logout" href="logout.php?logout">Logout here</a>
	</center>
</body>
</html>
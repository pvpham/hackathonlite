<?php
session_start();
include_once 'Dbconnect.php';

if(isset($_SESSION['user']) != '1')
{
 header("Location: default.php");
}
if (isset($_POST['btn-search'])){
	$cname = mysql_real_escape_string($_POST['cname']);
	$found = mysql_query("SELECT COUNT(*) FROM cdata WHERE name = '$cname'");
	$foundRow = mysql_fetch_array($found);
	if($foundRow[0]>0){
		$res = mysql_query("SELECT * FROM cdata where name='$cname'");
		?>

		<div id="display">
		<?php
		echo"Name: ". $cname;

		while ($crow=mysql_fetch_array($res)) {
			echo "<br>";
			echo "<br>";
			echo "Address: ". $crow['address'];
			echo "<br>";
			echo "State: ". $crow['state'];
			echo "<br>";
			echo "Amount: $". $crow['amount'];
			echo "<br>";
			echo "Date: ". $crow['date'];
			echo "<br>";
			echo "Committee type: ". $crow['ctype'];
			echo "<br>";
			echo "State type: ". $crow['stype'];
		}
		?>
		</div>
		<?php
	}
	else {
		?>
		<div id="not_found">
		<?php
		echo"Your search of Committee: ". $cname;
		echo" was not found.";
		?>
		</div>
		<?php
	}
}

?>

<html>
<head>
	<title>View</title>
	<style>
	html{
		background-image: url("finance.jpg");
		background-repeat: no-repeat;
		background-size: cover;
	}
	input[type=text], select {
	    width: 100%;
	    padding: 12px 20px;
	    margin: 8px 0;
	    display: inline-block;
	    border: 1px solid #ccc;
	    border-radius: 4px;
	    box-sizing: border-box;
	}

	button[type=submit], select{
		background-color: white; 
	    border: 1px solid #ccc;
	    color: black;
	    padding: 12px 20px;
	    text-align: center;
	    text-decoration: none;
	    display: inline-block;
	    font-size: 14px;

	}

	#register{

        background-color:#ffffff;
        font-size: 16pt;
    }

    #logout{

        background-color:#ffffff;
        font-size: 16pt;
    }

    #display{
    	width: 400px;
    	background-color: white;
    	border-style: solid;
		border-color: black;
		box-shadow: 10px 10px 5px black;
    }

    #not_found{
    	width: 400px;
    	background-color: white;
    	border-style: solid;
		border-color: black;
		box-shadow: 10px 10px 5px black;
    }

	</style>
</head>
<body>
	<center>
		<div id="search-form">
			<form method="post">
				<table align="center" border="0">
				<tr>
					<td><input type="text" name="cname" placeholder="Committee name" required/></td>
					<td><button type="submit" name="btn-search">Search</button></td>
				</tr>
				<tr>
					<td><a id="logout" href="logout.php?logout">Logout here</a></td>
				</tr>
				<tr>
					<td><a id="register" href="registration.php">Register more users here</a></td>
				</table>
			</form>
	</center>
</body>
</html>


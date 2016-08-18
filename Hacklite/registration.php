<?php
session_start();
include_once 'Dbconnect.php';

if(isset($_SESSION['user']) != '1')
{
 header("Location: default.php");
}

if(isset($_POST['btn-register']))
{
	$uname = mysql_real_escape_string($_POST['uname']);
	$upass = md5(mysql_real_escape_string($_POST['pass']));

	if (mysql_query("INSERT INTO users(username, password) VALUES('$uname','$upass')"))
	{
		?>
			<script>alert('Successfully registered new user!'); </script>
			<?php
	}
	else
	{
		?>
			<script>alert('Error while registering user. Username is in use.'); </script>
			<?php
	}

}
?>

<html>
<head>
<title>Registration</title>
<style>
	html{
		background-image: url("seats.png");
		background-repeat: no-repeat;
		background-size: cover;
	}

	h2{
		font-size: 32pt;
		text-shadow: 4px 4px black;
		color:white;
		font-family: Arial;
		text-align: center;
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

	#logout{
		background-color:#ffffff;
        font-size: 20pt;
	}

	#view{
		background-color:#ffffff;
        font-size: 20pt;
	}


</style>
</head>
<body>
<h2>Enter Desired Username and Password</h2>
<center>
	<div id="register-form">
		<form method="post">
			<table align="center" width="30%" border="0">
				<tr>
					<td><input type="text" name="uname" placeholder="User Name" required /></td>
				</tr>
				<tr>
					<td><input type="text" name="pass" placeholder="Password" required/></td>
				</tr>
				<tr>
					<td><button type="submit" name="btn-register">Register</button></td>
				</tr>
			</table>
		</form>
	</div>
	<br>
	<a id ="view" href="view.php">View the data here</a>
	<p></p>
	<br>
	<a id ="logout" href="logout.php?logout">Logout here</a>
</center>
</body>
</html>
<?php
session_start();
include_once 'Dbconnect.php';

if(isset($_POST['btn-login']))
{
 $uname = mysql_real_escape_string($_POST['uname']);
 $upass = mysql_real_escape_string($_POST['pass']);
 $res=mysql_query("SELECT * FROM users WHERE username ='$uname'");
 $row=mysql_fetch_array($res);
 if($row['password']==md5($upass))
 {
 	if($row['username'] == 'admin'){
 	$_SESSION['user'] = $row['user_id'];
 	header("Location: view.php");
 	}
 	else {	
  	$_SESSION['user'] = $row['user_id'];
  	header("Location: categorize.php");
 }
}
 else
 {
  ?>
        <script>alert('wrong details');</script>
        <?php
 }
 
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>

<style>
    html{
        background-image: url("seats.png");
        background-size: cover;
        background-repeat: no-repeat;
    }
	
    h2{
		text-shadow: 4px 4px black;
		color:white;
		font-family: Arial;
		text-align: center;
		font-size: 72pt;
	}

    h3{
        text-shadow: 4px 4px black;
        color:white;
        font-family: Arial;
        text-align: center;
        font-size: 24pt;
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
	
    input[type=password], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}


</style>
</style>
</head>
<body>
<h2>Welcome!</h2>
<center>
    <div id="login-form">
        <form method="post">
            <table align="center" border="0">
                <h3>Login</h3>
                <tr>
                    <td><input type="text" name="uname" placeholder="Your Username" required /></td>
                </tr>
                <tr>
                    <td><input type="password" name="pass" placeholder="Your Password" required /></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn-login">Sign In</button></td>
                </tr>
            </table>
        </form>
    </div>
</center>
</body>
</html>
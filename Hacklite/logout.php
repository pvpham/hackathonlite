<?php
session_start();

if(!isset($_SESSION['user']))
{
	header("Location: default.php");
}
else if(isset($_SESSION['user'])!= "1")
{
	header("Location: categorize.php");
}
else if(isset($_SESSION['user']) == "1")
{
	header("Location: view.php");
}

if(isset($_GET['logout']))
{
	session_destroy();
	unset($_SESSION['user']);
	header("Location: default.php");
}
?>
<?php

session_start();

if(isset($_SESSION['User_id']))
{
	unset($_SESSION['User_id']);
}

header("Location: homepage.php");
die;

?>
<?php 

	$host="localhost";
	$user="root";
	$password="";
	$db="php_con";
	$con=mysqli_connect($host,$user,$password,$db);
	if(mysqli_connect_errno())
		die("Not connected");
	

 ?>
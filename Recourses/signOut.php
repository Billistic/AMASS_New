<?php  
	session_start(); 
	session_unset();
	session_destroy();
	$URL='login.html'; 
	header ("Location: $URL");
?>
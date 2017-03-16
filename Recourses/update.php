<?php
	session_start(); 
	require 'vendor/autoload.php';
	$firebase = Firebase::fromServiceAccount('google-service-account.json');
	$database = $firebase->getDatabase();
	$uid = '';
	$uid = (isset($_SESSION['uid']) ? $_SESSION['uid'] : null);
	
	$username = '';
	$password='';
	$email = '';
	$firstname = '';
	$lastname = '';
	$mobile = '';

	$username=(isset($_POST['uname']) ? $_POST['uname'] : null);
	$password=(isset($_POST['pwd']) ? $_POST['pwd'] : null);
	$email=(isset($_POST['Email']) ? $_POST['Email'] : null);
	$firstname=(isset($_POST['fn']) ? $_POST['fn'] : null);
	$lastname=(isset($_POST['ln']) ? $_POST['ln'] : null);
	$mobile=(isset($_POST['mob']) ? $_POST['mob'] : null);
	
	if($username!=null){
		$database -> getReference('data/users/'.$uid)->getChild('Username')->set($username);
	}
	
	if($password !=null){
		$database -> getReference('data/users/'.$uid)->getChild('Password')->set($password);
	}
	
	if($email !=null){
		$database -> getReference('data/users/'.$uid)->getChild('Email')->set($email);
	}
	
	if($firstname !=null){
		$database -> getReference('data/users/'.$uid)->getChild('First Name')->set($firstname);
	}
	
	if($lastname !=null){
		$database -> getReference('data/users/'.$uid)->getChild('Last Name')->set($lastname);
	}
	
	if($mobile !=null){
		$database -> getReference('data/users/'.$uid)->getChild('Mobile')->set($mobile);
	}
	
	$URL="profile.php"; 
	header ("Location: $URL");

?>
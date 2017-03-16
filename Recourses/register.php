<?php
	session_start();
	require 'vendor/autoload.php';

	$register_email = 'c';
	$register_fn = 'c';
	$register_ln = 'c';
	$register_mob = 'c';
	$register_pwd = 'c';
	$register_uname = '';

	$register_email = (isset($_POST['registerEmail']) ? $_POST['registerEmail'] : null);

	$register_fn = (isset($_POST['register_fn']) ? $_POST['register_fn'] : null);

	$register_ln = (isset($_POST['register_ln']) ? $_POST['register_ln'] : null);

	$register_mob = (isset($_POST['register_mob']) ? $_POST['register_mob'] : null);

	$register_pwd = (isset($_POST['register_pwd']) ? $_POST['register_pwd'] : null);

	$register_uname = (isset($_POST['register_uname']) ? $_POST['register_uname'] : null);

	$firebase = Firebase::fromServiceAccount('google-service-account.json');

	$database = $firebase->getDatabase();

	$keys = $database -> getReference("data/users") ->getChildkeys();

	$snap = $database -> getReference("data/users") ->getSnapshot();

	$bool = false;

	foreach($keys as $x){
		if($snap -> getChild('"'.$x.'"') -> getChild('Email') -> getValue() == $register_email){
			$bool = true;
			break;
		}
	}

	if($bool != true){
		$postRef = $database->getReference('data/users')
		   ->push([
				   'First Name' => $register_fn,
				   'Last Name' => $register_ln,
				   'Email' => $register_email,
				   'Mobile' => $register_mob,
				   'Password' => $register_pwd,
				   'Username' => $register_uname,
				   'Vehicles' =>[],
				  ]);
			  
		$key = $postRef->getKey();
		$_SESSION["uid"]=$key;
		$_SESSION["name"]=$register_fn;
		$URL="dash.php"; 
		header ("Location: $URL"); 
	}else{
		$URL="login.html"; 
		header ("Location: $URL"); 
	}
?>
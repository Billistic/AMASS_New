<?php  
	session_start(); 
	require 'vendor/autoload.php';
	$reg='';
	$reg=(isset($_POST['stat']) ? $_POST['stat'] : null);
	$firebase = Firebase::fromServiceAccount('google-service-account.json');
	$database = $firebase->getDatabase();
	$snap = $database->getReference("data/vehicles")->getSnapshot();
	$children = $database->getReference("data/vehicles")->getChildkeys();
	foreach($children as $x){
		if($snap->getChild('"'.$x.'"')->getChild("Registration")->getValue() == $reg){
			$database->getReference("data/vehicles/".$x."/Status")->set(0);
			break;
		}
	}
	$URL="cars.php"; 
	header ("Location: $URL")
?>
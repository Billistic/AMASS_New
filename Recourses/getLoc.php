<?php 
	session_start(); 
	require 'vendor/autoload.php';
	$firebase = Firebase::fromServiceAccount('google-service-account.json');
	$database = $firebase->getDatabase();
	$vehicles = $database->getReference("data/vehicles")->getChildkeys();
	
	$uid = '';
	$uid = (isset($_SESSION['uid']) ? $_SESSION['uid'] : null);
	
	$date = '';
	$reg = '';
	$stack = array();
	
	$reg = (isset($_POST['active_reg']) ? $_POST['active_reg'] : null);
	$date = (isset($_POST['dateTime']) ? $_POST['dateTime'] : null);
	
	$format = substr($date,5);
	$date = substr($format,3);
	$format = substr($format,0,2);
	$date = $date.'/'.$format;
	
	
	foreach($vehicles as $x){
		if($database->getReference("data/vehicles/".$x)->getChild('Registration')->getValue() == $reg){
			$snap =  $database->getReference("data/vehicles/".$x."/Locations")->getSnapshot();
			$boo = $snap->hasChildren();
			if($boo == true){
				$localkeys = $database->getReference("data/vehicles/".$x."/Locations")->getChildkeys();
				
				foreach($localkeys as $y){
					if($snap->getChild('"'.$y.'"')->getChild('Date')->getValue() == $date){
						$mark = array();
						$a =  $date;
						$b =  $snap->getChild('"'.$y.'"')->getChild("Latitude")->getValue();
						
						if($b != 0.0000000){
							$c =  $snap->getChild('"'.$y.'"')->getChild("Longitude")->getValue();
							$d =  $snap->getChild('"'.$y.'"')->getChild("Time")->getValue();
							array_push($mark,$a);
							array_push($mark,$b);
							array_push($mark,$c);
							array_push($mark,$d);
							array_push($stack, $mark);
						}
					}
				}
			}
			break;
		}
	}
	$_SESSION['Table_Array'] = $stack;
	$URL="statistics.php"; 
	header ("Location: $URL"); 
?>
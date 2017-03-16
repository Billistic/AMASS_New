<?php  
	session_start(); 
	require 'vendor/autoload.php';
	$reg = '';
	$reg=(isset($_SESSION['lookUp']) ? $_SESSION['lookUp'] : null);
	$firebase = Firebase::fromServiceAccount('google-service-account.json');
	$database = $firebase->getDatabase();
	$vehicles = $database->getReference("data/vehicles")->getChildkeys();
	$snap = $database->getReference("data/vehicles")->getSnapshot();
	
	foreach($vehicles as $x){
		if($reg == $snap->getChild('"'.$x.'"')->getChild('Registration')->getValue()){
			$list = $database -> getReference('data/vehicles/'.$x.'/Locations')->getChildkeys();
			header("Content-type: text/xml");
			echo '<markers>';
			echo '<marker ';
			echo 'lat="' .  $database -> getReference('data/vehicles/'.$x.'/Locations/'.end($list))->getChild("Latitude")->getValue() . '" ';
			echo 'lng="' .  $database -> getReference('data/vehicles/'.$x.'/Locations/'.end($list))->getChild("Longitude")->getValue() . '" ';
			echo '>';
			echo '</marker>';
			echo '</markers>';
			break;
		}
	}
?>
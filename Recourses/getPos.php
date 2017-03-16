<?php 
	session_start(); 
	require 'vendor/autoload.php';

	$firebase = Firebase::fromServiceAccount('google-service-account.json');
	$database = $firebase->getDatabase();
	$uid = '';
	$uid = (isset($_SESSION['uid']) ? $_SESSION['uid'] : null);
	$reference = $database->getReference('data/users/'.$uid.'/Vehicles');
	
	if($reference!=null){
		$vehicleStamp = null;
		try {
			$vehicleStamp = $reference->getChildKeys();
			$snap = $reference->getSnapshot();
		} catch (Exception $e) {}
		if($vehicleStamp!=null){
			header("Content-type: text/xml");
			echo '<markers>';
			foreach($vehicleStamp as $x){
				echo '<marker ';
				echo 'reg="' . $snap->getChild('"'.$x.'"')->getChild("Registration")->getValue() . '" ';
				echo 'lat="' . $snap->getChild('"'.$x.'"')->getChild("Latitude")->getValue() . '" ';
				echo 'lng="' . $snap->getChild('"'.$x.'"')->getChild("Longitude")->getValue() . '" ';
				echo '>';
				echo '</marker>';
			}
			echo '</markers>';
		}
	}
?>
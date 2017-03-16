<?php
	require 'vendor/autoload.php';

	$registration = '01D9873'; //do the get here.
	$latitude = 'hi'; //do the get here.
	$longitude = 'hi'; //do the get here.
	$time = 'hi'; //just make it a string (format) hrs:minutes
	$date = 'hi'; //just make it a string (format) date:month
	$uid = NULL; //this is set further down in code leave this.
	$vid = NULL; //this is set further down in code leave this.

	$firebase = Firebase::fromServiceAccount('google-service-account.json');

	$database = $firebase->getDatabase();

	$list = $database->getReference('data/vehicles')->getChildKeys();
	
	//gets the user who ownes the car and sets the location history;

	foreach($list as $x){
	
		$snap = $database -> getReference('data/vehicles/'.$x);
		$temp_reg = $snap->getChild('Registration')->getValue();
		if($temp_reg==$registration){
			$uid = $snap->getChild('UID')->getValue();
			$vid = $snap->getChild('VID')->getValue();
			$database -> getReference('data/vehicles/'.$x.'/Locations')
				->push([
					'Longitude' => $longitude,
					'Latitude' => $latitude,
					'Time' => $time,
					'Date' => $date,
				]);
			break;
		}
	}
	
	//update the cars location for google maps
	
	if($uid != NULL){
		$ReferenceLocation = $database->getReference('data/users/'.$uid.'/Vehicles/'.$vid);
		$ReferenceLocation->getChild('Longitude')->set( $longitude);
		$ReferenceLocation->getChild('Latitude')->set( $latitude);
	}
	sleep(2);

?>


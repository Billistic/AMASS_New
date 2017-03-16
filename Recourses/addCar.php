<?php 
session_start();
require 'vendor/autoload.php';


$reg = '';
$make='';
$model='';
$year='';
$uid='';

$reg=(isset($_POST['registration']) ? $_POST['registration'] : null);
$make=(isset($_POST['make']) ? $_POST['make'] : null);
$model=(isset($_POST['type']) ? $_POST['type'] : null);
$year=(isset($_POST['year']) ? $_POST['year'] : null);
$uid = (isset($_SESSION['uid']) ? $_SESSION['uid'] : null);

$firebase = Firebase::fromServiceAccount('google-service-account.json');
$database = $firebase->getDatabase();

$keyRef = $database->getReference('data/users/'.$uid.'/Vehicles')
	->push([
		   'Make' => $make,
		   'Model' => $model,
		   'Year' => $year,
		   'Registration' => $reg,
		   'Longitude' => 'NULL',
		   'Latitude' => 'NULL',
	]);
	
$vid = $keyRef->getKey();

$database->getReference('data/vehicles')
	->push([
			'Registration' => $reg,
		    'UID' => $uid,
			'VID' => $vid,
	]);


$URL='cars.php?'.SID; 
header ("Location: $URL");
?>
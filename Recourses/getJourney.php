<?php 
	session_start();
	$lat = '';
	$lng = '';
	$stack = array();
	$heap = array();
	$stack = (isset($_SESSION['Table_Array']) ? $_SESSION['Table_Array'] : null);
	if($stack!=null){
		//removes duplicates
		
		foreach($stack as $x){
			$os = array($x[1],  $x[2]);
			if (in_array($os, $heap)) {}else{
				array_push($heap,$os);
			}
		}
		
		//if the list exceeds max size we make it more vague, by removing close elements, the distance will expand until the heap is a length of 23//
		if(count($heap) > 23){
			$temp = $heap;//temp copy;
			$size = .05;
			while(count($temp) > 23){
				//echo '<br><br>'.count($temp).'<br>';
				for($i = 0; $i < count($heap); $i++){
					$arr = $heap[$i];
					$lat1 = $arr[0];
					$lng1 = $arr[1];
					for($y = $i+1; $y < count($heap); $y++){
						$arr2 = $heap[$y];
						$lat2 = $arr2[0];
						$lng2 = $arr2[1];
						$theta = $lng1 - $lng2;
						$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
						$dist = acos($dist);
						$dist = rad2deg($dist);
						$miles = $dist * 60 * 1.1515;

						$ans = ($miles * 1.609344); //transform to kmh
						//echo 'distance is: '.$ans.' size is: '.$size.'<br>';
						if($ans < $size){
							 unset($temp[$y]);
						}
					}
				}
				$size = $size+$size;
			}
			$heap = $temp;
		}
		
		//transforms to xml for use by maps
		header("Content-type: text/xml");
		echo '<markers>';
		foreach($heap as $x){
			$lat = $x[0];
			$lng = $x[1];
			if($lng != ""){
				if($lat != ""){
					echo '<marker ';
					echo 'lat="' . $lat . '" ';
					echo 'lng="' . $lng . '" ';
					echo '>';
					echo '</marker>';
				}
			}
		}
		echo '</markers>';
	}
	
?>
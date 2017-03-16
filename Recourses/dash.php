<?php  
session_start(); 
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<meta name="description" content="reliable car security for a safe and comfortable lifestyle">
		<meta name="keywords" content="car, security, arduino, CIT, DCOMM, Louise Walshe, Conor Twomey, Ryan Meany, Joshua Nuttall">
		<meta name="author" content="Joshua Nuttall - R00128796">
		<title>AMASS | About</title>
		<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="./css/boot.css">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
		
	</head>
	<body>
		<header>
			<div class="container">
				<div id="branding">
					<h1>Amass Security</h1>
				</div>
				<nav>
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="about.php">About</a></li>
						<li><a href="services.php">Track</a></li>
						<?php 
							echo '<li class="current"><a href="dash.php">'.$_SESSION["name"].'</a></li>';
						?>
					</ul>
				</nav>
			</div>
		</header>
		
		<div class="display-table-cell v-align box" id="navigation">
			<div class="navi">
				<ul>
					<li class="active"><a href="dash.php"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li>
				    <li><a href="cars.php? <?php echo SID;?>"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Cars</span></a></li>
					<li><a href="profile.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Profile</span></a></li>
					<li><a href="statistics.php"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Calender</span></a></li>
					<li><a href="signOut.php"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Sign-Out</span></a></li>
				</ul>
			</div>
		</div>
		
		<div class="display-table-cell v-align">
			<div class="user-dashboard2">
				<div id="map_canvas"></div>
				<script>	
						function downloadUrl(url,callback) {

							var request = window.ActiveXObject ?
							new ActiveXObject('Microsoft.XMLHTTP') :
							new XMLHttpRequest;

							request.onreadystatechange = function() {
								if (request.readyState == 4) {
									request.onreadystatechange = doNothing;
									callback(request, request.status);
								}
							};

							request.open('GET', url, true);
							request.send(null);
						}
				
				
					function initMap() {
						var cork = {lat:  51.885581, lng:-8.533957};
						var map = new google.maps.Map(document.getElementById('map_canvas'), {
							zoom: 13,
							scrollwheel: false,
							center: cork,
							styles:[
								{elementType: 'geometry', stylers: [{color: '#242f3e'}]},
								{elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
								{elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
								{featureType: 'administrative.locality', elementType: 'labels.text.fill',  stylers: [{color: '#d59563'}]},
								{featureType: 'poi',elementType: 'labels.text.fill',stylers: [{color: '#d59563'}]},
								{featureType: 'poi.park',elementType: 'geometry',stylers: [{color: '#263c3f'}]},
								{featureType: 'poi.park',elementType: 'labels.text.fill',stylers: [{color: '#6b9a76'}]},
								{featureType: 'road',elementType: 'geometry',stylers: [{color: '#38414e'}]},
								{featureType: 'road',elementType: 'geometry.stroke',stylers: [{color: '#212a37'}]},
								{featureType: 'road',elementType: 'labels.text.fill',stylers: [{color: '#9ca5b3'}]},
								{featureType: 'road.highway',elementType: 'geometry',stylers: [{color: '#746855'}]},
								{featureType: 'road.highway',elementType: 'geometry.stroke',stylers: [{color: '#1f2835'}]},
								{featureType: 'road.highway',elementType: 'labels.text.fill',stylers: [{color: '#f3d19c'}]},
								{featureType: 'transit',elementType: 'geometry',stylers: [{color: '#2f3948'}]},
								{featureType: 'transit.station',elementType: 'labels.text.fill',stylers: [{color: '#d59563'}]},
								{featureType: 'water',elementType: 'geometry',stylers: [{color: '#17263c'}]},
								{featureType: 'water',elementType: 'labels.text.fill',stylers: [{color: '#515c6d'}]},
								{featureType: 'water',elementType: 'labels.text.stroke',stylers: [{color: '#17263c'}]}
							]
						});
						
						var infoWindow = new google.maps.InfoWindow;

						// Change this depending on the name of your PHP or XML file
						downloadUrl('getPos.php', function(data) {
							var xml = data.responseXML;
							var markers = xml.documentElement.getElementsByTagName('marker');
							Array.prototype.forEach.call(markers, function(markerElem) {
								var reg = markerElem.getAttribute('reg');
							    var type = markerElem.getAttribute('reg');
							    var point = new google.maps.LatLng(
								    parseFloat(markerElem.getAttribute('lat')),
								    parseFloat(markerElem.getAttribute('lng')));

							    var infowincontent = document.createElement('div');
							    var strong = document.createElement('strong');
							    strong.textContent = reg
							    infowincontent.appendChild(strong);
							    infowincontent.appendChild(document.createElement('br'));
								
							    var marker = new google.maps.Marker({
									map: map,
									position: point,
									icon: 'marker_green.png'
								});
								
								marker.addListener('click', function() {
									infoWindow.setContent(infowincontent);
									infoWindow.open(map, marker);
								});
							  
							});
						});
				    }
				function doNothing() {}
				</script>
				<script async defer
					src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoEssCulS3T6zZfbgBONYk7jJwJzgoz40&callback=initMap">
				</script>
			</div>
		</div>
		
		
		<div>			
			<footer>
				<p>Amass Security, Copyright &copy; 2017</p>
			</footer>
		</div>
		
	</body>
</html>
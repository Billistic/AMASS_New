<?php  
session_start(); 
require 'vendor/autoload.php';
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
		<link rel="stylesheet" href="./css/modal.css">
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
		
		<div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
			
			<div class="navi">
				<ul>
					<li><a href="dash.php"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li>
					<li class="active"><a href="cars.php"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Cars</span></a></li>
					<li><a href="profile.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Profile</span></a></li>
					<li><a href="statistics.php"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Calender</span></a></li>
					<li><a href="signOut.php"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Sign-Out</span></a></li>
				</ul>
			</div>
		</div>
		
		<div class="display-table-cell v-align">
			<div class="user-dashboard">
				<div class="table-title">
					<h1>Cars</h1>
				</div>
				
				<table class="table-fill">
					<thead>
						<tr>
							<th class="text-left">Registration</th>
							<th class="text-left">Longitude</th>
							<th class="text-left">Latitude</th>
							<th class="text-left">Status</th>
						</tr>
					</thead>
					<tbody class="table-hover">
						<?php
							$firebase = Firebase::fromServiceAccount('google-service-account.json');
							$database = $firebase->getDatabase();
							$uid = '';
							$uid = (isset($_SESSION['uid']) ? $_SESSION['uid'] : null);
							$reference = $database->getReference('data/users/'.$uid.'/Vehicles')->getSnapshot();
							$button = 'Kill';
							
							if($reference!=null){
									$vehicleStamp = null;
									try {
										$vehicleStamp = $database->getReference('data/users/'.$uid.'/Vehicles')->getChildKeys();
									} catch (Exception $e) {}
									if($vehicleStamp==null){
										echo 	'<tr>
													<td class="text-left">No Cars</td>
													<td class="text-left">Null</td>
													<td class="text-left">Null</td>
													<td class="text-left">Null</td>
												</tr>';
									}else{
										foreach($vehicleStamp as $x){									
											echo 	'<tr>
														<td class="text-left">'.$reference->getChild('"'.$x.'"')->getChild('Registration')->getValue().'</td>
														<td class="text-left">'.$reference->getChild('"'.$x.'"')->getChild('Longitude')->getValue().'</td>
														<td class="text-left">'.$reference->getChild('"'.$x.'"')->getChild('Latitude')->getValue().'</td>
														<td class="text-left"><form action="status.php" method = "post"><button type="submit" class="track_button" value="'.$reference->getChild('"'.$x.'"')->getChild('Registration')->getValue().'" name= "stat">'.$button.'</button></form></td>
													</tr>';
										}
									}
							}
						?>
					</tbody>
				</table>
				<!-- Trigger/Open The Modal -->
				<button id="myBtn" class="track_button">Add</button>

				<!-- The Modal -->
				<div id="myModal" class="modal">
				  <!-- Modal content -->
					<div class="modal-content">
						<div class="modal-header">
							<span class="close">&times;</span>
							<h2>Add Car</h2>
						</div>
						<div class="modal-body">
							<form action="<?php echo 'addCar.php?'.SID;?>" method = "post">
								<input type="text" name="registration" placeholder="Registration..."/> 
								<input type="text" name="make" placeholder="Make..."/>
								<input type="text" name="type" placeholder="Type..."/>
								<input type="text" name="year" placeholder="Year..."/>
								<button type="submit" class="track_button">Add</button>
							</form>
						</div>
						<div class="modal-footer">
						    <h3>Amass Security, Copyright &copy; 2017</h3>
						</div>
					</div>
				</div>
				<script>
						// Get the modal
						var modal = document.getElementById("myModal");

						// Get the button that opens the modal
						var btn = document.getElementById("myBtn");

						// Get the <span> element that closes the modal
						var span = document.getElementsByClassName("close")[0];

						// When the user clicks the button, open the modal 
						btn.onclick = function() {
							modal.style.display = "block";
						}

						// When the user clicks on <span> (x), close the modal
						span.onclick = function() {
							modal.style.display = "none";
						}

						// When the user clicks anywhere outside of the modal, close it
						window.onclick = function(event) {
							if (event.target == modal) {
								modal.style.display = "none";
							}
						}
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
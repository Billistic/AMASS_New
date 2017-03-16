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
		<link rel="stylesheet" href="./css/trial.css">
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
		
		<div class=" hidden-xs display-table-cell v-align box" id="navigation">
			
			<div class="navi">
				<ul>
					<li><a href="dash.php"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li>
					<li><a href="cars.php"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Cars</span></a></li>
					<li><a href="profile.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Profile</span></a></li>
					<li class="active"><a href="statistics.php"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Calender</span></a></li>
					<li><a href="signOut.php"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Sign-Out</span></a></li>
				</ul>
			</div>
		</div>
		
		<div class="display-table-cell v-align">
				<div id="profileInf">
					<h1>Calendar:</h1>
					<form action="getLoc.php" method = "post" >
						<input type="Date" name = "dateTime" required/><br>
						<input type="text" name = "active_reg" placeholder= "Registration" required/>
						<input type="submit" class="track_button" placeholder="Save"></input>
					</form>
					<table class="table-fill">
						<thead>
							<tr>
								<th class="text-left">Date</th>
								<th class="text-left">Longitude</th>
								<th class="text-left">Latitude</th>
								<th class="text-left">Time</th>
							</tr>
						</thead>
						<tbody class="table-hover">
							<?php 
								$stack = '';
								$stack = (isset($_SESSION['Table_Array']) ? $_SESSION['Table_Array'] : null);
								if($stack!=null){
									foreach($stack as $x){
										echo 	'<tr>';
										foreach($x as $y){
											echo 	'<td class="text-left">'.$y.'</td>';
										}
										echo 	'</tr>';
									}
								}
							?>
						</tbody>
					</table>
					<form action="Visualizer.php" method = "post" >
						<Button type="submit" class="track_button">Visualize</Button>
					</form>
				</div>
			</div>
		</div>
		
		<div>			
			<footer>
				<p>Amass Security, Copyright &copy; 2017</p>
			</footer>
		</div>
	</body>
</html>
<?php  
	session_start(); 
?>
<!DOCTYPE html?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<meta name="description" content="reliable car security for a safe and comfortable lifestyle">
		<meta name="keywords" content="car, security, arduino, CIT, DCOMM, Louise Walshe, Conor Twomey, Ryan Meany, Joshua Nuttall">
		<meta name="author" content="Joshua Nuttall - R00128796">
		<title>AMASS | About</title>
		<link rel="stylesheet" href="./css/style.css">
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
						<li class="current"><a href="about.php">About</a></li>
						<li><a href="services.php">Track</a></li>
						<?php  
							$uid = '';
							$uid = (isset($_SESSION['uid']) ? $_SESSION['uid'] : null);
							if($uid!=null){
								echo '<li><a href="dash.php">'.$_SESSION["name"].'</a></li>';
							}else{
								echo '<li><a href="login.html">Login</a></li>';
							}
						?>
					</ul>
				</nav>
			</div>
		</header>
		
		<section id="track">
			<div class="container">
				<h1>Track by Registration</h1>
				<form action="services.php" method="post">
					<input type="text" name = 'reg' id ="tracking_reg" placeholder="Enter Registration..."> 
					<button type="submit" id ="track_submit" class="track_button">Track</button>
				</form>
			</div>
		</section>
		
		<section id="main">
			<div class="container">
				<article id="main-col">
					<h1 class="title">About us</h1>
					<p>In recent years, we have witnessed an explosion of interest in security based applications in all domains of computer science. Such rapid change has created opportunities for the unscrupulous as well as the entrepreneurial.
					</p>
					<p>A small computer services firm views this as an opportunity to dramatically change and expand their business. Tired of simply providing IT support services, they now want to move up the value chain by developing and marketing a product for the automobile market. 
					</p>
					<p>The firm has approached your team looking for a bespoke hardware/software solution.  You are tasked with the development of the Automobile Management & Security System (AMASS) for this firm.
					</p>
				</article>
				
				<aside id="side">
					<div class="dark">
						<h3 id="spec">The project Spec</h3>
						<p>Anti-theft features:<hr>
						Automatic theft notification via SMS<br>
						Recording images of thieves<br>
						Posting of recorded images directly to Facebook & twitter feeds<br>
						Automatic phone notification to a central emergency line<br>
						Remote shut down of the vehicle (this may be simulated)<br><br>
						Management features<hr>
						Remote, real time, tracking of the vehicle on Google Maps<br>
						Store all journeys travelled<br>
						Basic Analytics for sales reps<br>
						Start / finish times <br>
						Mileage covered <br>
						Length of time spent driving<br>
						Custom designed feature unique to each group (each group implements a unique feature not already outlined in this spec).
						</p>
					</div>
				</aside>
			</div>
		</section>
		
		<footer>
			<p>Amass Security, Copyright &copy; 2017</p>
		</footer>
		
	</body>
</html>
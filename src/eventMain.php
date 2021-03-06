<!DOCTYPE HTML>
<?php include 'connectDB.php'; ?>
<!--
	Retrospect by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>LATERK by Later we think of name k.</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<div class="inner">
						<script>function myFunction() {
						var d = new Date();
						var n = d.getTimezoneOffset();				
						document.getElementById("gmt").value = n/-60;				
						}
						window.onload = myFunction;
					</script>
	</head>
	<body class="landing">

		<!-- Header -->
			<header id="header" class="alt">
				<h1><a href="index.php">Laterk</a></h1>
				<a href="#nav">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="nav">
				<ul class="links">
					<li><a href="index.php">Home</a></li>
					<li><a href="input.php">Enter time</a></li>
					<li><a href="newEvent.php">Create event</a></li>
				</ul>
			</nav>
		<!-- Four -->
			<section id="four" class="wrapper style2 special">
				<div class="inner">
					<header class="major narrow">
					<?php
						$sql="SELECT event_name FROM event_list WHERE event_code = '" . $_GET['event'] . "'"; 
						$result = $conn->query($sql);
						$row = mysqli_fetch_assoc($result);
						echo "<h2>". $row['event_name'] . "</h2>";?>
					</header>
					<div class="container 75%">
						<div class="row uniform 50%">
							<div class="12u$">
								<div class="table-wrapper">
									<table>
										<thead>
											<tr>
												<th>Participant</th>
												<th>Code link</th>
											</tr>
										</thead>
										<tbody>
											<!-- Put for loop here to display retrieved participants -->
											<?php
											$sql="SELECT DISTINCT u.shortlink, u.username FROM event_participants e, user_data u WHERE e.event_code = '" . $_GET['event'] . "' && u.shortlink = e.shortlink"; 
											$result = $conn->query($sql);
											while($row = mysqli_fetch_assoc($result)){
												echo '<tr>';
												echo '<td>';
												echo $row['username'];
												echo '</td>';
												echo '<td>'; 
												echo $row['shortlink'];
												echo '</td>';
												echo '</tr>';
											}
											?>											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			
			<?php
				if (isset($_GET['returnStr'])){
					?>
			<section id="three" class="wrapper special">
				<div class="inner">
					<header class="major special">
						<?php echo "<h2>". $_GET['returnStr'] ."</h2>";?>
					</header>
				</div>
			</section>
			<?php } ?>
			
			<section id="two" class="wrapper style1">
				<div class="inner">	
					<form action="addNewParticipant.php" method="POST">
						<h2>Add a new friend or type in your code to see what's your best time to meet! </h2>
						<input name="shortlink" placeholder="Enter an unique code link" type="text" />
						<input type="hidden" name="gmt" id="gmt" />		
						<?php echo '<input type="hidden" name="event_code" value="'.$_GET['event'].'">'; ?>
						<ul class="actions">
							<li><input type="submit" class="special" value="Submit" /></li>
						</ul>
					</form>
				</div>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<!--
					<ul class="icons">
						<li><a href="#" class="icon fa-facebook">
							<span class="label">Facebook</span>
						</a></li>
						<li><a href="#" class="icon fa-twitter">
							<span class="label">Twitter</span>
						</a></li>
						<li><a href="#" class="icon fa-instagram">
							<span class="label">Instagram</span>
						</a></li>
						<li><a href="#" class="icon fa-linkedin">
							<span class="label">LinkedIn</span>
						</a></li>
					</ul>
					-->
					<ul class="copyright">
						<li>&copy; Later we think of name k.</li>
						<li>Design: <a href="http://templated.co">TEMPLATED</a>.</li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>
<!DOCTYPE HTML>
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
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script>
			
		  $(function() {
			$( "#slider-range" ).slider({
			  range: true,
			  min: 0,
			  max: 24,
			  values: [ 0, 24 ],
			  slide: function( event, ui ) {
				$( "#amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
			  }
			});
			$( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) +
			  " - " + $( "#slider-range" ).slider( "values", 1 ) );
			  
		  });
		  
		
			
			function myFunction() {
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
						<h2>Enter time</h2>
						<p>Busy like a bee you are...</p>
					</header>
					<form action="submit_input.php" method="POST">
						<div class="container 75%">
							<div class="row uniform 50%">
								<div class="12u$">
									<input name="name" placeholder="Enter your name" type="text" />
									<br />
									
									<p>Enter your preferred time period
										<input name="amount" type="text" id="amount" readonly>
									</p>
									<div id="slider-range"></div>
									<br />
									
									<p>GMT:<input name="gmt" type="text" id="gmt" readonly></p>
									
								</div>
							</div>
						</div>
						<ul class="actions">
						
							<?php
								if ($_GET['shortlink']==""){
									echo '<li><input type="submit" class="special" value="Get code link" /></li>';
								} else{
									echo 'YOUR CODE IS ' . $_GET['shortlink'];
								}
								?>
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
			<!--<script src="assets/js/jquery.min.js"></script>-->
			<!--<script src="assets/js/slider_time.js"></script>-->
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>

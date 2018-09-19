<?php
	include 'models.php';
	include 'taconnect.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>The Accounts</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	</head>
	<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
	<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />
	<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
	<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />
	<link rel="stylesheet" href="assets/contactform.css" type='text/css' />
	<link rel="stylesheet" href="assets/placesonly.css" type='text/css' />
	<body>
		<header>
			<nav class="navbar">
				<a href="/">
					<img class="navlogo" src="assets/placesonly.png">
				</a>
			</nav>
		</header>
		<?php require_once 'addmapcontent.php'; ?>
		<footer>
			<!-- Footer -->
		</footer>
	</body>
</html>
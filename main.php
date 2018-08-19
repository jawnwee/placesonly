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
	 <link rel="stylesheet" href="assets/the-accounts.css">
	</head>
	<script src='https://api.mapbox.com/mapbox-gl-js/v0.47.0/mapbox-gl.js'></script>
	<link href='https://api.mapbox.com/mapbox-gl-js/v0.47.0/mapbox-gl.css' rel='stylesheet' />
	<body>
		<?php require_once 'header.php'; ?>
		<div class="grid">
			<div class="container">
				<?php require_once 'content.php'; ?>
			</div>
			<div id='map' style='width: 400px; height: 300px;'></div>
				<script>
				mapboxgl.accessToken = 'pk.eyJ1IjoiamF3bndlZSIsImEiOiJjamwwMTgwYmwxMDV1M3FwNDAweWs3cGV6In0.39iMWxPjecfKgJZIW4zz9g';
				var map = new mapboxgl.Map({
					container: 'map',
				  	// style URL
					style: 'mapbox://styles/jawnwee/cjl0422b96lls2rparbxgyaqp',
				  	// initial position in [lon, lat] format
					center: [ -122.420586,
        					37.758606],
				  	// initial zoom
				 	zoom: 14
				});
				</script>
			</div>
		<footer>
			<!-- Footer -->
		</footer>
	</body>
</html>
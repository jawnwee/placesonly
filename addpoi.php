<?php
	require_once('../config.php');
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, "theaccounts");
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
	$locName = $_POST['locname'];
	$lat = $_POST['lat'];
	$lng =  $_POST['lng'];
	$email =  $_POST['email'];
	$message =  $_POST['message'];
	$addsqlquery = '';
	if ($message != "") {
		$addsqlquery = "INSERT INTO suggestions (loc_name, lat, lng, emai, message) VALUES ('".$locName."', '".$lat."','".$lng."', '".$email."', '".$message."')";
	} else if ($locName != "" && $lat != "" && $lng != "" && $email != "") {
		$addsqlquery = "INSERT INTO suggestions (loc_name, lat, lng, email) VALUES ('".$locName."', '".$lat."','".$lng."', '".$email."')";
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Places Only</title>
		<link rel="shortcut icon" href="https://placesonly.s3-us-west-1.amazonaws.com/favicon.ico?v=2" type="image/x-icon">
		<link rel="icon" href="https://placesonly.s3-us-west-1.amazonaws.com/favicon.ico?v=2" type="image/x-icon">
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
			<?php if(!$result = $conn->query($addsqlquery)): ?>
				failed!
			<?php else: ?>
				<div class="form-submit-thanks">
					<h1>
						Thank You!
					</h1>
					<h3>
						Your submission will be reviewed soon!
					</h3>
				</div>
			<?php endif; ?>
		</header>
		<footer>
			<!-- Footer -->
		</footer>
	</body>
</html>
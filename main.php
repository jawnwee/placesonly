<?php
	include 'models.php';
	include 'taconnect.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Places Only</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	 <link rel="stylesheet" href="assets/placesonly.css">
	</head>
	<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
	<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<body>
		<header>
			<nav class="navbar">
				<a href="/">
					<img class="navlogo" src="assets/placesonly.png">
				</a>
			</nav>
		</header>
		<div class="introduction">
			<h1 class="frontpage-header">
				Some caption here...
			</h1>
		</div>
		<div class="frontpage-container">
			<div id='frontpage-listings' class='frontpage-listings'></div>
		</div>
		<footer>
			<!-- Footer -->
		</footer>
		<script>
			var frontpageLocations = [
			{
				name: 'San Francisco',
				image: 'https://s3-us-west-1.amazonaws.com/the-accounts/sf.jpeg',
				destination: 'bay-area'
			},
			{
				name: 'San Francisco',
				image: 'https://s3-us-west-1.amazonaws.com/the-accounts/sf.jpeg',
				destination: 'bay-area'
			},
			{
				name: 'San Francisco',
				image: 'https://s3-us-west-1.amazonaws.com/the-accounts/sf.jpeg',
				destination: 'bay-area'
			},
			{
				name: 'San Francisco',
				image: 'https://s3-us-west-1.amazonaws.com/the-accounts/sf.jpeg',
				destination: 'bay-area'
			}];
			function buildFrontPage(data) {
				data.forEach(function(location) {
    				var listings = document.getElementById('frontpage-listings');
    				var anchor = listings.appendChild(document.createElement('a'));
				    anchor.href = '/explore?destination=' + location.destination;
    				var listing = anchor.appendChild(document.createElement('div'));
				    listing.className = 'frontpage-item';
				    listing.style.backgroundImage = "url('" + location.image + "')";

				    var detail = listing.appendChild(document.createElement('div'));
				    detail.className = 'frontpage-item-detail-container';

				    // Create a new link with the class 'title' for each store
				    // and fill it with the store address
				    var name = detail.appendChild(document.createElement('h2'));
				    name.className = 'frontpage-item-detail-name';
				    name.innerHTML = location.name;
				});
			}
			buildFrontPage(frontpageLocations);
		</script>
	</body>
</html>
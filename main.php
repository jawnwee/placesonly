<?php
	include 'models.php';
	include 'taconnect.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<link rel="shortcut icon" href="https://placesonly.s3-us-west-1.amazonaws.com/favicon.ico?v=2" type="image/x-icon">
		<link rel="icon" href="https://placesonly.s3-us-west-1.amazonaws.com/favicon.ico?v=2" type="image/x-icon">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Places Only</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="" />
		<link rel="stylesheet" href="assets/placesonly.css">
	</head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<body>
		<header class="introduction">
			<nav class="navbar">
				<a href="/">
					<img class="navlogo" src="assets/placesonly.png">
				</a>
				<div class="link-list">
		    		<a href="/add">
			    		<button class="button -main center">
			    			<i class="fas fa-plus fa-fw"></i>
			    			New Location
			    		</button>
		    		</a>
		    	</div>
			</nav>
		</header>
		<div class="introduction">
			<div class="front-page-header-container">
				<h1 class="frontpage-header">
					Discover Places to
				</h1>
				<div class="front-page-description">
					<h1 id="front-content-1" class="front-content">
						Experience
					</h1>
				</div>
				<div class="front-page-description">
					<h1 id="front-content-2" class="front-content">
						Explore
					</h1>
				</div>
				<div class="front-page-description">
					<h1 id="front-content-3" class="front-content">
						Instagram
					</h1>
				</div>
				<div class="front-page-description">
					<h1 id="front-content-4" class="front-content">
						Explore
					</h1>
				</div>
				<div>
					<div class="front-page-anti">
						<h1 class="front-page-anti-header">
							Ratings
						</h1>
						<h1 class="front-page-anti-comma"> , </h1>
					</div>
					<div class="front-page-anti">
						<h1 class="front-page-anti-header">
							Reviews
						</h1>
						<h1 class="front-page-anti-comma">,</h1>
					</div>
					<div class="front-page-anti">
						<h1 class="front-page-anti-header">
							B.S
						</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="frontpage-container">
			<div id='frontpage-listings' class='frontpage-listings'></div>
		</div>
		<footer>
			<!-- Footer -->
		</footer>
		<script>
			var divs = $('h1[id^="front-content-"]').hide(),
			    i = 0;

			(function cycle() { 

			    divs.eq(i).fadeIn(400)
			              .delay(1000)
			              .fadeOut(400, cycle);

			    i = ++i % divs.length;

			})();
			var frontpageLocations = [
			{
				name: 'San Francisco',
				image: 'https://placesonly.s3-us-west-1.amazonaws.com/sf.jpeg',
				destination: 'bay-area'
			},
			{
				name: 'New York City',
				image: 'https://placesonly.s3-us-west-1.amazonaws.com/nyc.jpg',
				destination: 'nyc'
			},
			{
				name: 'Los Angeles',
				image: 'https://placesonly.s3-us-west-1.amazonaws.com/la.jpg',
				destination: 'los-angeles'
			},
			{
				name: 'Portland',
				image: 'https://placesonly.s3-us-west-1.amazonaws.com/portland.jpg',
				destination: 'portland'
			},
			{
				name: 'Seattle',
				image: 'https://placesonly.s3-us-west-1.amazonaws.com/seattle.jpg',
				destination: 'seattle'
			},
			{
				name: 'Chicago',
				image: 'https://placesonly.s3-us-west-1.amazonaws.com/chicago.jpg',
				destination: 'chicago'
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
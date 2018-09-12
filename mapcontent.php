<?php
	global $conn;
	$poisSql = "SELECT loc_name, address, city, state, country, lat, lng, image_url, account_url, about, type, reg_date FROM pois ORDER BY NEWID()";
	$result = mysqli_query($conn, $poisSql);
	$pois = array();
	if ($result && mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_array($result)) {
        	$poi = new PointOfInterest();
        	$poi->setLocationName($row["loc_name"]);
        	$poi->setAddress($row["address"]);
        	$poi->setCity($row["city"]);
        	$poi->setState($row["state"]);
        	$poi->setCountry($row["country"]);
        	$poi->setLat($row["lat"]);
        	$poi->setLng($row["lng"]);
        	$poi->setImageURL($row["image_url"]);
        	$poi->setAccountURL($row["account_url"]);
        	$poi->setAbout($row["about"]);
        	$poi->setType($row["type"]);
        	array_push($pois, $poi);
	    }
	}

	function getPois() {
		global $pois;
		return $pois;
	}

	function getPoisMapData() {
		global $pois;
		$jsonObjects = array();
		foreach($pois as $poi) {
			$type = $poi->getType();
			$marker = "circle-15";
			if ($type == 'food') {
				$marker = "food";
			} else if ($type == 'activity') {
				$marker = "playground";
			} else if ($type == 'nature') {
				$marker = "natural-feature";
			}
			$json = '{
					"type": "Feature",
					"geometry": {
						"type": "Point",
						"coordinates": [' . $poi->getLng() . ' , ' . $poi->getLat() . ']
					},
					"properties": {
      					"name": "' . $poi->getLocName() . '",
      					"address":  "' . $poi->getAddress() . '",
      					"image": "' . $poi->getImageURL() . '",
      					"url": "' . $poi->getAccountURL() . '",
      					"marker-symbol": "' . $marker . '"
      				}
				}';
			array_push($jsonObjects, $json);
		}
		return $jsonObjects;
	}
?>
<div id="dbgger"></div>
<div class="container">
	<div class="sidebar">
		<div id='listings' class='listings'></div>
	</div>
	<div class="map-wrapper">
		<div id='map'/>
	</div>
</div>
<script>
		function flyToLocation(currentFeature) {
		  map.flyTo({
		    center: currentFeature.geometry.coordinates,
		    zoom: 15
		  });
		}
		function createPopUp(feature) {
			var popUps = document.getElementsByClassName('mapboxgl-popup');
		  	// Check if there is already a popup on the map and if so, remove it
		  	if (popUps[0]) popUps[0].remove();

		  	var popup = new mapboxgl.Popup({ offset: [0, -5], closeOnCLick: true, closeButton: false })
		    	.setLngLat(feature.geometry.coordinates)
		    	.setHTML('<a href=' + feature.properties.url + ' class="popup-url">' + feature.properties.name + '</a>')
		    	.setLngLat(feature.geometry.coordinates)
		    	.addTo(map);
		}

		function buildLocationList(data) {
		  // Iterate through the list of stores
		  for (i = 0; i < data.features.length; i++) {
		    var currentFeature = data.features[i];
		    // Shorten data.feature.properties to just `prop` so we're not
		    // writing this long form over and over again.
		    var prop = currentFeature.properties;
		    // Select the listing container in the HTML and append a div
		    // with the class 'item' for each store
		    var listings = document.getElementById('listings');
		    var listing = listings.appendChild(document.createElement('div'));
		    listing.className = 'poi-item';
		    listing.style.backgroundImage = "url('" + prop.image + "')";
		    listing.dataPosition = i;

		    // var image = listing.appendChild(document.createElement('img'));
		    // image.src = prop.image;
		    // image.className = 'poi-item-image';

		    var detail = listing.appendChild(document.createElement('div'));
		    detail.className = 'poi-item-detail-container';

		    // Create a new link with the class 'title' for each store
		    // and fill it with the store address
		    var name = detail.appendChild(document.createElement('h3'));
		    name.className = 'poi-item-detail-name';
		    name.innerHTML = prop.name;

		    var address = detail.appendChild(document.createElement('p'));
		    address.className = 'poi-item-detail-address';
		    address.innerHTML = prop.address;

		    // Add an event listener for the links in the sidebar listing
			listing.addEventListener('click', function(e) {
			  // Update the currentFeature to the store associated with the clicked link
			  var clickedListing = data.features[this.dataPosition];
			  flyToLocation(clickedListing);
			  createPopUp(clickedListing);
			  // 3. Highlight listing in sidebar (and remove highlight for all other listings)
			  var activeItem = document.getElementsByClassName('active');
			  if (activeItem[0]) {
			    activeItem[0].classList.remove('active');
			  }
			  this.parentNode.classList.add('active');
			}, false);
		  }
		}
		mapboxgl.accessToken = 'pk.eyJ1IjoiamF3bndlZSIsImEiOiJjamwwMTgwYmwxMDV1M3FwNDAweWs3cGV6In0.39iMWxPjecfKgJZIW4zz9g';
		var dbPois = []
       	<?php foreach(getPoisMapData() as $poi): ?>
       		dbPois.push(<?php echo $poi; ?>);
       	<?php endforeach; ?>
		var pois = {
   			"type": "FeatureCollection",
   			"features": dbPois
       	};
       	var dbgger = document.getElementById('dbgger');
       	// dbgger.innerHTML = dbPois;
		var map = new mapboxgl.Map({
			container: 'map',
		  	// style URL
			style: 'mapbox://styles/jawnwee/cjl041w346kce2sl020ckjd8k',
			sprite: "mapbox://sprites/mapbox/bright-v9",

		  	// initial position in [lon, lat] format
			center: [-122.421 , 37.7586],
		  	// initial zoom
		 	zoom: 14
		});
		map.on('load', function () {
			map.addSource('main', {
		  		type: 'geojson',
		  		data: pois
			}); 
			map.addLayer({
		        "id": "point",
		        "source": "main",
		        "type": "symbol",
		        "layout": {
            		"icon-image": "m-circle-15",
            		'icon-allow-overlap': true,
            	}
		    });
		    buildLocationList(pois);
		});

		map.on('click', function(e) {
		  var features = map.queryRenderedFeatures(e.point, {
		    layers: ['point'] // replace this with the name of the layer
		  });

		  if (!features.length) {
		    return;
		  }
		  createPopUp(features[0]);
		  
		});

		map.on('mouseenter', 'point', function(e) {
	        // Change the cursor style as a UI indicator.
	        map.getCanvas().style.cursor = 'pointer';

	        createPopUp(e.features[0]);
	    });

	    map.on('mouseleave', 'point', function() {
	        map.getCanvas().style.cursor = '';
	    });
</script>
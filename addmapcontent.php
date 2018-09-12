<?php
    global $conn;
    $poisSql = "SELECT loc_name, address, city, state, country, lat, lng, image_url, account_url, about, reg_date FROM pois";
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
                        "marker-symbol": "circle-15"
                    }
                }';
            array_push($jsonObjects, $json);
        }
        return $jsonObjects;
    }
?>
<div class="container">
    <div class="sidebar">
        <div class="addsidebar">
            <form class="add-form validate-form" action="addpoi" method="post">
                <span class="label-input100">Point of Interest</span>
                <div id='geocoder' class='geocoder validate-input'></div>
                <div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="text" name="email" placeholder="">
                    <span class="focus-input100"></span>
                </div>
                <div class="wrap-input100 rs1-wrap-input100">
                    <span class="label-input100">Message</span>
                    <textarea class="input100" name="message" placeholder=""></textarea>
                    <span class="focus-input100"></span>
                </div>
                <input class="input100" type="hidden" name="lat" id="poi-coordinates-lat">
                <input class="input100" type="hidden" name="lng" id="poi-coordinates-lng">
                <div class="container-contact100-form-btn">
                    <button class="contact100-form-btn">
                        <span>
                            Submit
                            <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="map-wrapper">
        <div id='map'/>
    </div>
</div>
<script src="jquery/jquery-3.2.1.min.js"></script>
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiamF3bndlZSIsImEiOiJjamwwMTgwYmwxMDV1M3FwNDAweWs3cGV6In0.39iMWxPjecfKgJZIW4zz9g';
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

    var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        placeholder: ""
    });
    document.getElementById('geocoder').appendChild(geocoder.onAdd(map));

    map.on('load', function() {
        map.addSource('single-point', {
            "type": "geojson",
            "data": {
                "type": "FeatureCollection",
                "features": []
            }
        });

        map.addLayer({
            "id": "point",
            "source": "single-point",
            "type": "circle",
            "paint": {
                "circle-radius": 10,
                "circle-color": "#007cbf"
            }
        });

        // Listen for the `result` event from the MapboxGeocoder that is triggered when a user
        // makes a selection and add a symbol that matches the result.
        geocoder.on('result', function(ev) {
            map.getSource('single-point').setData(ev.result.geometry);
            var poiCoordinatesLat = document.getElementById("poi-coordinates-lat");
            poiCoordinatesLat.value = ev.result.geometry.coordinates[0];
            var poiCoordinatesLng = document.getElementById("poi-coordinates-lng");
            poiCoordinatesLng.value = ev.result.geometry.coordinates[1];
        });

        map.on('click', function (e) {
            var coordinates = [e.lngLat.lng, e.lngLat.lat];
            var geometry = {
                "type": "Point",
                "coordinates": coordinates
            }
            map.getSource('single-point').setData(geometry);
            var poiCoordinatesLat = document.getElementById("poi-coordinates-lat");
            poiCoordinatesLat.value = ev.result.geometry.coordinates[0];
            var poiCoordinatesLng = document.getElementById("poi-coordinates-lng");
            poiCoordinatesLng.value = ev.result.geometry.coordinates[1];
        });

    });

    (function ($) {
        "use strict";

        /*==================================================================
        [ Focus Contact2 ]*/
        $('.input100').each(function(){
            $(this).on('blur', function(){
                if($(this).val().trim() != "") {
                    $(this).addClass('has-val');
                }
                else {
                    $(this).removeClass('has-val');
                }
            })    
        })

        /*==================================================================
        [ Validate ]*/
        var input = $('.validate-input .input100');
        var geocoder = $('.validate-input .mapboxgl-ctrl-geocoder input');
        $(geocoder[0]).attr("name", "locname");
        var parentGeocoder = $(geocoder[0]).parent();
        $(parentGeocoder).attr("data-validate", "Select a Location");

        $('.validate-form').on('submit',function(){
            var check = true;

            for(var i=0; i<input.length; i++) {
                if(validate(input[i]) == false){
                    showValidate(input[i]);
                    check=false;
                }
            }

            for(var i=0; i<geocoder.length; i++) {
                if(validate(geocoder[i]) == false){
                    showPoiValidate(geocoder[i]);
                    check=false;
                }
            }

            return check;
        });


        $('.validate-form .input100').each(function(){
            $(this).focus(function(){
               hideValidate(this);
            });
        });

        $('.mapboxgl-ctrl-geocoder input').each(function(){
            $(this).focus(function(){
               hidePoiValidate(this);
            });
        });

        function validate (input) {
            if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
                if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                    return false;
                }
            }
            else {
                if($(input).val().trim() == ''){
                    return false;
                }
            }
        }

        function showValidate(input) {
            var thisAlert = $(input).parent();

            $(thisAlert).addClass('alert-validate');
        }

        function hideValidate(input) {
            var thisAlert = $(input).parent();

            $(thisAlert).removeClass('alert-validate');
        }
        
        function showPoiValidate(input) {
            var thisAlert = $(input).parent();

            $(thisAlert).addClass('alert-validate');
        }

        function hidePoiValidate(input) {
            var thisAlert = $(input).parent();

            $(thisAlert).removeClass('alert-validate');
        }

        /*==================================================================
        [ Show / hide Form ]*/
        
        $('.contact100-btn-hide').on('click', function(){
            $('.wrap-contact100').fadeOut(400);
        })

        $('.contact100-btn-show').on('click', function(){
            $('.wrap-contact100').fadeIn(400);
        })

    })(jQuery);

</script>
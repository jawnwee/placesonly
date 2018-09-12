<?php
	// Grabs the URI and breaks it apart in case we have querystring stuff
	$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
	// debug_to_console($request_uri);
	// Route it up!
	// Default to bay area
	// debug_to_console($paramArr["destination"]);
	$dest_param = '';
	if ($request_uri[0] == '/explore') {
		if ($request_uri[1]) {
			$paramArr = [];
			$str = $request_uri[1];
			parse_str($str, $paramArr);
			$dest_param =  $paramArr['destination'];
		}
	}

	switch ($request_uri[0]) {
	    // Home page
	    case '/':
	        require 'main.php';
	        break;
	    case '/explore':
	    	require 'explore.php';
	    	break;
	    // add
	    case '/add':
	        require 'add.php';
	        break;
	   	case '/addpoi.php':
	    case '/addpoi':
	    	require 'addpoi.php';
	    	break;
	    // Everything else
	    default:
	        header('HTTP/1.0 404 Not Found');
	        require 'main.php';
	        break;
	}

	function debug_to_console( $data ) {
	    $output = $data;
	    if ( is_array( $output ) )
	        $output = implode( ',', $output);

	    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
	}
?>
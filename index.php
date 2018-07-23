<?php
	// Grabs the URI and breaks it apart in case we have querystring stuff
	$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
	// Route it up!
	switch ($request_uri[0]) {
	    // Home page
	    case '/':
	        require 'main.php';
	        break;
	    // add
	    case '/add':
	        require 'add.php';
	        break;
	    case '/addaccount':
	    	require 'addaccount.php';
	    	break;
	    // Everything else
	    default:
	        header('HTTP/1.0 404 Not Found');
	        require 'add.php';
	        break;
	}
?>
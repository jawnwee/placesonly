<?php
	require_once('../config.php');
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, "theaccounts");

	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
?>
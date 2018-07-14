<?php
	require_once('../config.php');
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, "theaccounts");
	$testvar = "testing123";
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
	// echo $conn;

	$sql = "SELECT username, about, url FROM accounts";
	echo $testvar;
	// echo $conn;
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_array($result)) {
	        echo $row;
	    }
	    echo "success";
	} else {
	    echo "0 results";
	}
?>
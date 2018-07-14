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
	echo $result;
	if (mysqli_num_rows($result) > 0) {
	    echo "<table><tr><th>ID</th><th>Name</th></tr>";
	    // output data of each row
	    while($row = mysqli_fetch_array($result)) {
	        echo "<tr><td>".$row["username"]."</td><td>".$row["about"]."</td></tr>";
	    }
	    echo "</table>";
	} else {
	    echo "0 results";
	}
?>
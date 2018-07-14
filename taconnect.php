<?php
	require_once('../config.php');
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, "theaccounts");

	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}

	function getAccounts2() {
		$sql = "SELECT username, about, url FROM accounts";
		echo "test";
		echo $conn;
		$result = mysqli_query($conn, $sql);
		echo "test";
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
	}
?>
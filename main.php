<?php
	include 'models.php';
	require_once('./taconnect.php');

	function getAccounts() {
		$sql = "SELECT username, about, url FROM accounts";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    echo "<table><tr><th>ID</th><th>Name</th></tr>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo "<tr><td>".$row["username"]."</td><td>".$row["about"]."</td></tr>";
		    }
		    echo "</table>";
		} else {
		    echo "0 results";
		}
	}

?>
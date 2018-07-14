<?php
	include 'models.php';
	include 'taconnect.php';

	function getAccounts() {
		$sql = "SELECT username, about, url FROM accounts";
		echo $conn;
		echo $testvar;
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
	}

?>
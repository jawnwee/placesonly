<?php
	include 'models.php';
	include 'taconnect.php';

	function getAccounts() {
		global $conn;
		$sql = "SELECT username, about, url FROM accounts";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_array($result)) {
	        	echo $row["username"];
		    }
		} else {
		    echo "0 results";
		}
	}

?>
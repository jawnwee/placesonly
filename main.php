<?php
	include 'models.php';
	include 'taconnect.php';

	function getAccounts() {
		$sql = "SELECT username, about, url FROM accounts";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_array($result)) {
		        echo $row;
		    }
		    echo "success";
		} else {
		    echo "0 results";
		}
	}

?>
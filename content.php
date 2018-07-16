<?php
	function getAccounts() {
		global $conn;
		$sql = "SELECT username, about, url FROM accounts";
		$result = mysqli_query($conn, $sql);
		$accounts = array();
		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_array($result)) {
	        	$acc = new Account();
	        	$acc->setUsername($row["username"]);
	        	$acc->setAbout($row["about"]);
	        	array_push($accounts, $acc);
		    }
		    return $accounts;
		} else {
		    echo "0 results";
		}
	}
?>
<div>
	<?php foreach(getAccounts() as $acc) : ?>
		<div>
			<?php $acc->getUsername(); ?>
		</div>
	<?php endforeach; ?>
</div>
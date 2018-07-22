<?php
	function getAccounts() {
		global $conn;
		$sql = "SELECT username, about, account_url, profile_image_url FROM accounts";
		$result = mysqli_query($conn, $sql);
		$accounts = array();
		if ($result && mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_array($result)) {
	        	$acc = new Account();
	        	$acc->setUsername($row["username"]);
	        	$acc->setAccountURL($row["account_url"]);
	        	$acc->setProfileImageURL($row["profile_image_url"]);
	        	$acc->setAbout($row["about"]);
	        	array_push($accounts, $acc);
		    }
		    return $accounts;
		}
	}
?>
<div class="site-info">
	<h1>
		Find content creators who </br> share incredile work through their lens
	</h1>
</div>
<div class="main-feed">
	<?php 
		if($accs = getAccounts()) :
			foreach(getAccounts() as $acc) : ?>
				<a href="<?php $acc->getAccountURL(); ?>">
					<div class="card-container">
						<img class="profile-image" src="<?php $acc->getProfileImageURL(); ?>">
						<div class="profile-details">
							<h2><?php $acc->getUsername(); ?></h2>
							<p class="about"><?php $acc->getAbout(); ?></p>
						</div>
					</div>
				</a>
			<?php 
			endforeach; 
		endif;
	?>
</div>
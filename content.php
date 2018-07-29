<?php
	global $conn;
	$accountsSql = "SELECT username, about, account_url, profile_image_url, platform, reg_date FROM accounts";
	$result = mysqli_query($conn, $accountsSql);
	$accounts = array();
	if ($result && mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_array($result)) {
        	$acc = new Account();
        	$acc->setUsername($row["username"]);
        	$acc->setAccountURL($row["account_url"]);
        	$acc->setProfileImageURL($row["profile_image_url"]);
        	$acc->setAbout($row["about"]);
        	$acc->setRegDate($row["reg_date"]);
        	if ($row["platform"] == "instagram") {
        		$acc->setPlatformImageURL("https://lh3.googleusercontent.com/EaHr0wIbTsvnUVAmIPKEVGhd4CMcI2lo9IXZa3u_uTepzsDeWyb5NyNcgpgz-vFfl5eqn3-wnv3xzRiCf9jyfk0_oBAnVdxhQ7mhaEtDSjAlLaUfyYcMpvegHvnbw1PGmyzafFoQ2Q=w2400");
        	}
        	array_push($accounts, $acc);
	    }
	}
	function getAccounts($date) {
		global $accounts;
		return array_filter($accounts, function($acc) use($date) {
			return $acc->getRegDate() == $date;
		});
	}
?>
<div class="site-info">
	<h1>
		Discover your favorite</br>content creators
	</h1>
	<!-- Begin MailChimp Signup Form -->
	<link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; width:100%;}
		#mc_embed_signup .button{background-color:#ED4956;}
				#mc_embed_signup .button:hover{background-color:#ED4956;}
		/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
		   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
	</style>
	<div id="mc_embed_signup">
	<form action="https://the-accounts.us18.list-manage.com/subscribe/post?u=90ce6f39cf21c630ec1b3176d&amp;id=beec86d5f4" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
	    <div id="mc_embed_signup_scroll">
		<h2>Sign up to receive a weekly recap from The Accounts</h2>
		<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
	    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
	    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_90ce6f39cf21c630ec1b3176d_beec86d5f4" tabindex="-1" value=""></div>
	    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
	    </div>
	</form>
	</div>

	<!--End mc_embed_signup-->
</div>
<div class="main-feed">
	<?php 
		// Set timezone
		date_default_timezone_set('UTC');

		// Start date
		$date = date("Y-m-d");
		// End date
		$end_date = '2018-6-31';

		while (strtotime($date) >= strtotime($end_date)):
			if($accs = getAccounts($date)) :
				$strDate = date("F jS", strtotime($date));
				if ($date == date("Y-m-d")) : ?>
					<div class="feed-date">
						<h2>Today</h2>
					</div>
				<?php
				else: ?>
					<div class="feed-date">
						<h2><?php echo $strDate; ?></h2>
					</div>
				<?php endif; 
				foreach($accs as $acc) : ?>
					<div class="card">
						<a href="<?php $acc->getAccountURL(); ?>">
							<div class="card-container">
								<img class="profile-image" src="<?php $acc->getProfileImageURL(); ?>"/>
								<div class="profile-details">
									<div class="profile-user-container">
										<h2 class="profile-username"><?php $acc->getUsername(); ?></h2>
										<img class="platform-image" src="<?php $acc->getPlatformImageURL(); ?>"/>
									</div>
									<p class="about"><?php $acc->getAbout(); ?></p>
								</div>
							</div>
						</a>
					</div>
				<?php 
				endforeach; 
			endif;
			$date = date ("Y-m-d", strtotime("-1 day", strtotime($date)));
		endwhile;
		?>
</div>
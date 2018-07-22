<?php
	include 'taconnect.php';
	$username = $_POST['username'];
	$accountURL =  $_POST['accountURL'];
	$about =  $_POST['about'];
	$platform = strtolower(gen_platform($accountURL));
	$profileImageURL = gen_profile_image_url($accountURL, $platform); 

	$addsqlquery="INSERT INTO accounts (username, profile_image_url, account_url, platform, about, reg_date) VALUES ('".$username."','".$profileImageURL."', '".$accountURL."', '".$platform."','".$about."', NOW())";

	if(!$result = $conn->query($addsqlquery)){
		die('There was an error running the query [' . $conn->error . ']');
	} else {
		
	}

	function gen_platform($url)  {
		$host = parse_url($url, PHP_URL_HOST);
		$domain = preg_replace('/^www\./', '', $host);
		$name = explode('.', $domain);
		return $name[0];
	}

	function gen_profile_image_url($url, $platform) {
		$ch = curl_init();
		$timeout = 5000;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$userAgent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		$html = curl_exec($ch);
		curl_close($ch);

		$dom = new DOMDocument;
		$dom->loadHTML($html);
		$xpath = new DOMXPath($dom);

		if ($platform == "instagram")  {
			$scripts = $xpath->query("//script");
			foreach ($scripts as $s) {
			    # see if there are any matches for var datePickerDate in the script node's contents
			    if (preg_match('/window._sharedData = (.*)/', $s->nodeValue, $matches)) {
			        # the date itself (captured in brackets) is in $matches[1]
			        $stripped = preg_replace( "/\p{Cc}*$/u", "", $matches[1]);
			        $extracted = explode(';', $stripped);
			        $json = $extracted[0];
			        $obj = json_decode($json);
			        if ($error = json_last_error()) {
				        $errorReference = [
				            JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded.',
				            JSON_ERROR_STATE_MISMATCH => 'Invalid or malformed JSON.',
				            JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded.',
				            JSON_ERROR_SYNTAX => 'Syntax error.',
				            JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded.',
				            JSON_ERROR_RECURSION => 'One or more recursive references in the value to be encoded.',
				            JSON_ERROR_INF_OR_NAN => 'One or more NAN or INF values in the value to be encoded.',
				            JSON_ERROR_UNSUPPORTED_TYPE => 'A value of a type that cannot be encoded was given.',
				        ];
				        $errStr = isset($errorReference[$error]) ? $errorReference[$error] : "Unknown error ($error)";
				        throw new \Exception("JSON decode error ($error): $errStr");
					}
			        return $obj->entry_data->ProfilePage[0]->graphql->user->profile_pic_url;
			    }
			}
		}
		return null;
	}
?>
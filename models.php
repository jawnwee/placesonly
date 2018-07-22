<?php
	class Account {
		var $username;
		var $accountURL;
		var $profileImageURL;
		var $about;

		function setUsername($username) {
			$this->username = $username;
		}

		function setAccountURL($url) {
			$this->accountURL = $url;
		}

		function setProfileImageURL($url) {
			$this->profileImageURL = $url;
		}

		function setAbout($about) {
			$this->about = $about;
		}

		function getUsername() {
			echo $this->username;
		}

		function getAccountURL() {
			echo $this->accountURL;
		}

		function getProfileImageURL() {
			echo $this->profileImageURL;
		}

		function getAbout() {
			echo $this->about;
		}
	}
?>
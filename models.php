<?php
	class Account {
		var $username;
		var $accountURL;
		var $profileImageURL;
		var $about;
		var $platformImageURL;
		var $regDate;

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

		function setPlatformImageURL($url) {
			$this->platformImageURL = $url;
		}

		function setRegDate($date) {
			$this->regDate = date("Y-m-d", strtotime($date));
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

		function getPlatformImageURL() {
			echo $this->platformImageURL;
		}

		function getRegDate() {
			return $this->regDate;
		}
	}
?>
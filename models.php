<?php
	class Account {
		var $username;
		var $about;

		function setUsername($username) {
			$this->username = $username;
		}

		function setAbout($about) {
			$this->about = $about;
		}

		function getUsername() {
			echo $this->username;
		}

		function getAbout() {
			echo $this->about;
		}
	}
?>
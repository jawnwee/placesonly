<?php
	class Account {
		var $displayName;
		var $username;
		var $accountURL;
		var $profileImageURL;
		var $about;
		var $platformImageURL;
		var $regDate;

		function setDisplayName($displayName) {
			$this->displayName = $displayName;
		}

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

		function getDisplayName() {
			echo $this->displayName;
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

	class PointOfInterest {
		var $locName;
		var $address;
		var $city;
		var $state;
		var $country;
		var $lat;
		var $lng;
		var $imageURL;
		var $accountName;
		var $accountURL;
		var $about;
		var $type;

		function setLocationName($locName) {
			$this->locName = $locName;
		}

		function setAddress($address) {
			$this->address = $address;
		}

		function setAccountName($name) {
			$this->accountName = $name;
		}

		function setAccountURL($url) {
			$this->accountURL = $url;
		}

		function setImageURL($url) {
			$this->imageURL = $url;
		}

		function setAbout($about) {
			$this->about = $about;
		}

		function setCity($city) {
			$this->city = $city;
		}

		function setState($state) {
			$this->state = $state;
		}

		function setCountry($country) {
			$this->country = $country;
		}

		function setLat($lat) {
			$this->lat = $lat;
		}

		function setLng($lng) {
			$this->lng = $lng;
		}

		function setType($type) {
			$this->type = $type;
		}

		function getLocName() {
			return $this->locName;
		}

		function getAddress() {
			return $this->address;
		}

		function getCity() {
			return $this->city;
		}

		function getState() {
			return $this->state;
		}

		function getCountry() {
			return $this->country;
		}

		function getAccountName() {
			return $this->accountName;
		}

		function getAccountURL() {
			return $this->accountURL;
		}

		function getImageURL() {
			return $this->imageURL;
		}

		function getAbout() {
			return $this->about;
		}

		function getLat() {
			return $this->lat;
		}

		function getLng() {
			return $this->lng;
		}

		function getType() {
			return $this->type;
		}
	}
?>
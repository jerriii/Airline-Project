<?php
	class User {
		public $userid;
		private $usertype;
		public $username;
		private $email;
		private $password;

		public function __construct($row) {
			$this->userid = $row['id'];
			$this->usertype = $row['user_type'];
			$this->email = $row['email'];
			$this->username = $row['username'];
			$this->password = $row['password'];
		}

		public function isAdmin() {
			return $this -> usertype == 'admin';
		}

		public function setUserInSession() {
			$_SESSION['user'] = [
				"id" => $this->userid,
				"user_type" => $this->usertype,
				"username" => $this->username,
				"email" => $this->email,
				"password" => $this->password
			];
		}

		public static function getUserFromSession() {
			return new User($_SESSION['user']);
		}

		public static function isLoggedIn() {
			return isset($_SESSION['user']);
		}

	}
?>
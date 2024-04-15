<?php
	if(!isset($_SESSION['errors']))
		$_SESSION['errors']=array();

	class ErrorHandler {
		const ERROR_LIST = [
			1 => "Enter email and password.",
			2 => "Empty email or password.",
			3 => "Wrong email or password.",
			4 => 'Username is required',
        	5 => 'Email is required',
        	6 => 'Password is required',
        	7 => 'Two passwords don\'t match', 
			8 => 'You are already logged in',
			9 => 'You are not logged in',
			10=> 'Not logged in as admin',
			11=> 'Required parameter not passed',
			12=> 'This email already exists'
		];

		static function error($err_code, $redirect) {
			array_push($_SESSION['errors'], $err_code);
			header('location: '.$redirect);
			die();
		}

		static function display_error()
		{
			if (count(@$_SESSION['errors']) > 0) {
				echo '<div class="error">';

			foreach (@$_SESSION['errors'] as $error) {
				echo ErrorHandler::ERROR_LIST[$error]. '<br>';
			}
				echo '</div>';
			}
			$_SESSION['errors']=array();
		}
	}
?>
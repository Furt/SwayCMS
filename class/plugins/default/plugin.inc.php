<?php
if(!defined('SCMS')) die('Hacking attempt!');

// default
class plugin {

	public $send_error = Array();
	public $head;

	private function securePass($pass) {
		$pass = md5($pass);
		return $pass;
	}

	public function checkAdmin() {
		if(!isset($_SESSION['admin'])) {
			print '<meta http-equiv="refresh" content="3;url=../index.php" />';
			die('<div align="center">You are not allowed here.<br />Redirecting you.</div>');
		}
	}

	//this function is incomplete user panel needs to be finished first
	public function changePass($user, $oldpass, $newpass) {
		//Encrypt old pass.
		$opass = $this->securePass($oldpass);

		//mysql connect
		$sql = new sql;
		$m = $sql->wconnect();
		
		//Check for correct account and pass info.
		$query = "SELECT `password` FROM users WHERE `account` = '". $user ."'";
		$result = mysqli_query($m, $query);
		if($result == $opass) {
			//Encrypt new pass
			$npass = $this->securePass($newpass);
				
			//Add new pass to account db.
			$queryp = "REPLACE INTO users (password) VALUES ($npass) WHERE `account` = '". $user ."'";
			mysqli_query($m, $queryp);
		}
		$sql->close($m);
	}

	public function recoverPass($user, $email) {
		$newpass = substr(md5(time()),0,6);
	}

	public function register($user, $pass, $email, $cap) {
		//encrypt pass.
		$password = $this->securePass($pass);

		//mysql connect.
		$sql = new sql;
		$m = $sql->wconnect();

		//check and see if account name is used.
		$check = "SELECT `id` FROM users WHERE `account` = '{$user}'";
		$rcheck = mysqli_query($m, $check);
		if(mysqli_num_rows($rcheck) > 0) {
			$this->send_error[] = 'This user already exists';
		}

		include_once './includes/securimage/securimage.php';
		$securimage = new Securimage();
		if ($securimage->check($cap) == false) {
			$this->send_error[] = 'The Captcha code was incorrect.';
		}
		if (empty($this->send_error)) {
			$query = mysqli_query($m, "INSERT INTO users (account,password,email) VALUES ('{$user}','{$password}','{$email}')");
			if(!$query) {
				$this->send_error[] = 'Insert query error.';
			}else{
				$this->send_error[] = 'Register complete!';
				$this->head = true;
			}
		}
		$sql->close($m);
	}

	public function login($user,$pass) {
		//encrypt pass.
		$password = $this->securePass($pass);

		//mysql connect.
		$sql = new sql;
		$m = $sql->wconnect();

		//checks to see if account name is in database.
		$ucheck = sprintf("SELECT `id` FROM users WHERE `account` = '%s'", addcslashes(mysqli_real_escape_string($m, $user),'%_'));
		$rucheck = mysqli_query($m, $ucheck);
		if(mysqli_num_rows($rucheck) != 1) {
			$this->send_error[] = 'Incorrect username.';
		}

		// checks to see if pass is correct
		$pcheck = sprintf("SELECT * FROM users WHERE `account` = '%s'", addcslashes(mysqli_real_escape_string($m, $user),'%_'));
		$prcheck = mysqli_query($m, $pcheck);
		while ($user_row = mysqli_fetch_assoc($prcheck)) {
			if ($password != $user_row['password']) {
				$this->send_error[] = 'Incorrect password.';
			}
		}

		if (empty($this->send_error)) {
			//gets the session data needed
			$query = mysqli_query($m, "SELECT id,account,admin,email FROM `users` WHERE account = '". $user ."'");
			if(!$query) {
				$this->send_error[] = 'Session save error.';
			}else{
				//save session data in a array
				$_SESSION['user'] = mysqli_fetch_row($query);

				// since theres 4 columns saved from query and first column starts as 0  the next ones will start as 4
				$_SESSION['user'][4] = "true";
				$_SESSION['user'][5] = date("m/d/Y, g:i a");

				// check if admin and set sessions
				if($_SESSION['user'][2] == '1') {
					$_SESSION['admin'] = mysqli_fetch_row($query);
					$_SESSION['admin'][4] = 'true';
				}

				// report good login
				$this->send_error[] = 'Your are now logged in.';
				$this->head = true;
			}
		}
		$sql->close($m);
	}
}
?>
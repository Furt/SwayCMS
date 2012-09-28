<?php
if(!defined('SCMS')) die('Hacking attempt!');

// otserv
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
		$sql->wconnect();

		//Check for correct account and pass info.
		$query = "SELECT `password` FROM users WHERE `account` = '". $user ."'";
		$result = mysql_query($query);
		if($result == $opass) {
			//Encrypt new pass
			$npass = $this->securePass($newpass);
				
			//Add new pass to account db.
			$queryp = "REPLACE INTO users (password) VALUES ($npass) WHERE `account` = '". $user ."'";
			mysql_query($queryp);
		}
		$sql->close();
	}

	public function recoverPass($user, $email) {
		$newpass = substr(md5(time()),0,6);
	}

	public function register($user, $pass, $email, $cap) {
		//encrypt pass.
		$password = $this->securePass($pass);

		//mysql connect.
		$sql = new sql;
		$sql->wconnect();

		//check and see if account name is used.
		$check = "SELECT `id` FROM users WHERE `account` = '{$user}'";
		$rcheck = mysql_query($check);
		if(mysql_num_rows($rcheck) > 0) {
			$this->send_error[] = 'This user already exists';
		}

		include_once './includes/secure/securimage.php';
		$securimage = new Securimage();
		if ($securimage->check($cap) == false) {
			$this->send_error[] = 'The Captcha code was incorrect.';
		}
		if (empty($this->send_error)) {
			$query = mysql_query("INSERT INTO accounts (name,password,email) VALUES ('{$user}','{$password}','{$email}')");
			if(!$query) {
				$this->send_error[] = 'Insert query error.';
			}else{
				$this->send_error[] = 'Register complete!';
				$this->head = true;
			}
		}
		$sql->close();
	}

	public function login($user,$pass) {
		//encrypt pass.
		$password = $this->securePass($pass);

		//mysql connect.
		$sql = new sql;
		$sql->wconnect();

		//checks to see if account name is in database.
		$ucheck = sprintf("SELECT `id` FROM accounts WHERE `name` = '%s'", addcslashes(mysql_real_escape_string($user),'%_'));
		$rucheck = mysql_query($ucheck);
		if(mysql_num_rows($rucheck) != 1) {
			$this->send_error[] = 'Incorrect username.';
		}

		// checks to see if pass is correct
		$pcheck = sprintf("SELECT * FROM accounts WHERE `name` = '%s'", addcslashes(mysql_real_escape_string($user),'%_'));
		$prcheck = mysql_query($pcheck);
		while ($user_row = mysql_fetch_assoc($prcheck)) {
			if ($password != $user_row['password']) {
				$this->send_error[] = 'Incorrect password.';
			}
		}

		if (empty($this->send_error)) {
			//gets the session data needed
			$query = mysql_query("SELECT id,name,premdays,email FROM `accounts` WHERE name = '". $user ."'");
			if(!$query) {
				$this->send_error[] = 'Session save error.';
			}else{
				//save session data in a array
				$_SESSION['user'] = mysql_fetch_row($query);

				// since theres 4 columns saved from query and first column starts as 0  the next ones will start as 4
				$_SESSION['user'][4] = "true";
				$_SESSION['user'][5] = date("m/d/Y, g:i a");

				// check if admin and set sessions
				if($_SESSION['user'][2] >= '1') {
					//$_SESSION['admin'] = mysql_fetch_row($query);
					//$_SESSION['admin'][4] = 'true';
				}

				// report good login
				$this->send_error[] = 'Your are now logged in.';
				$this->head = true;
			}
		}
		$sql->close();
	}
}
?>
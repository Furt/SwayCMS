<?php
if(!defined('SCMS')) die('Hacking attempt!');

// mangos
class plugin {

	public $send_error = Array();
	public $head;

	private function securePass($user, $pass) {
		$user = strtoupper($user);
		$pass = strtoupper($pass);
		return SHA1($user.':'.$pass);
	}

	public function checkAdmin() {
		if(!isset($_SESSION['admin'])) {
			print '<meta http-equiv="refresh" content="3;url=../index.php">';
			die('<center>You are not allowed here.<br>Redirecting you.</center>');
		}
	}

	public function changePass($user, $oldpass, $newpass) {
		//Encrypt old pass.
		$opass = $this->securePass($user, $oldpass);

		//mysql connect
		$sql = new sql();
		$sql->aconnect();

		//Check for correct account and pass info.
		$query = "SELECT `sha_pass_hash` FROM account WHERE username= '$user'";
		$result = mysql_query($query);
		if($result == $opass) {
			//Encrypt new pass
			$npass = $this->securePass($account, $npass);

			//Add new pass to account db.
			$queryp = "REPLACE INTO account (sha_pass_hash) VALUES ($npass) WHERE username= '$user'";
			mysql_query($queryp);
		}
		$sql->close();
	}

	public function register($user, $pass, $email, $cap) {
		$username = strtoupper($user);

		//encrypt pass.
		$password = $this->securePass($user,$pass);

		//mysql connect.
		$sql = new sql;
		$sql->aconnect();

		//check and see if account name is used.
		$checka = "SELECT `id` FROM account WHERE username= '$user'";
		$checka1 = mysql_query($checka);
		if(mysql_num_rows($checka1) > 0) {
			$this->send_error[] = 'This user is already exist';
		}
			
		include_once './includes/secure/securimage.php';
		$securimage = new Securimage();
		if ($securimage->check($cap) == false) {
			$this->send_error[] = 'The Captcha code was incorrect.';
		}
		if (empty($this->send_error)) {
			$query = mysql_query("INSERT INTO account (username,sha_pass_hash,email,expansion) VALUES ('$username','$password','$email','2')");
			if(!$query) {
				$this->send_error[] = 'Insert query error.';
			}else{
				$this->send_error[] = 'Register complete!';
				$this->head = true;
			}
		}
		$sql->close();
	}

	public function login($user, $pass) {
		//encrypt pass.
		$password = $this->securePass($pass);

		//mysql connect.
		$sql = new sql;
		$sql->aconnect();

		//checks to see if account name is in database.
		$ucheck = sprintf("SELECT id FROM `account` WHERE username='%s'", addcslashes(mysql_real_escape_string($user),'%_'));
		$rucheck = mysql_query($ucheck);
		if(mysql_num_rows($rucheck) != 1) {
			$this->send_error[] = 'Incorrect username.';
		}
			
		// checks to see if pass is correct
		$pcheck = sprintf("SELECT sha_pass_hash FROM `account` WHERE username='%s'", addcslashes(mysql_real_escape_string($password),'%_'));
		$prcheck = mysql_query($pcheck);
		while ($user_row = mysql_fetch_assoc($prcheck)) {
			if ($password != $user_row['password']) {
				$this->send_error[] = 'Incorrect password.';
			}
		}
		if (empty($this->send_error)) {
			//gets the session data needed
			$query = mysql_query("SELECT id,username,gmlevel,email FROM `account` WHERE username = '". $user ."'");
			if(!$query) {
				$this->send_error[] = 'Session save error.';
			}else{
				//save session data in a array
				$_SESSION['user'] = mysql_fetch_row($query);

				// since theres 4 columns saved from query and first column starts as 0  the next ones will start as 4
				$_SESSION['user'][4] = "true";
				$_SESSION['user'][5] = date("F j, Y, g:i a");

				// check if admin and set sessions
				if($_SESSION['user'][2] == '3') {
					$_SESSION['admin'] = mysql_fetch_row($query);
					$_SESSION['admin'][4] = 'true';
				}

				// report good login
				$this->send_error[] = 'Your are now logged in.';
				$this->head = true;
			}
		}
		$sql->close();
	}
}

function getRace($id) {
	$sql = new sql();
	$sql->wconnect();
	$raceQuery = "SELECT * FROM race WHERE raceid = '$id' LIMIT 1";
	$raceResult = mysql_query($raceQuery);
	if (!$raceResult) {
		$message  = mysql_error();
		error_reporting('E_NONE');
		echo $message;
	}
	while ($raceRow = mysql_fetch_assoc($raceResult)) {
		$name = $raceRow['name'];
	}

	return $name;
}


function getRaceFaction($id) {

	$sql = new sql();
	$sql->wconnect();
	$raceQuery = "SELECT * FROM race WHERE raceid = '$id' LIMIT 1";
	$raceResult = mysql_query($raceQuery);

	if (!$raceResult) {
		trigger_error("Race id wrong.");
	}

	while ($raceRow = mysql_fetch_assoc($raceResult)) {
		$faction = $raceRow['faction'];
	}

	return $faction;
}

function pharsegold($type, $gold) {

	if($type == "g") {
		$money_gold = (int)($gold/10000);
		$returngold = $money_gold ;
	}else if($type == "s") {
		$money_gold = (int)($gold/10000);
		$money_silver = (int)(($gold-$money_gold*10000)/100);
		$returngold = $money_silver;
	}else if($type == "c") {
		$money_gold = (int)($gold/10000);
		$money_silver = (int)(($gold-$money_gold*10000)/100);
		$money_cooper = (int)($gold-$money_gold*10000-$money_silver*100);
		$returngold = $money_cooper;
	}

	return $returngold;
}

function realmlist($id,$name, $ip, $port, $mysql, $sqlun, $sqlpass, $chardb, $maxplr) {
	connectremotes($mysql, $sqlun, $sqlpass, $chardb);
	$queryup = "SELECT  count(online) AS result_count FROM characters WHERE online = '1' LIMIT 1";
	$result2 = mysql_fetch_assoc(mysql_query($queryup));

	$countnum = $result2['result_count'];
	if($countnum <= "09") {
		$cntfin = str_replace("0", "", $result2['result_count']);
	} else if($countnum == "00") {
		$cntfin = "0";
	} else if(empty($countnum)) {
		$cntfin = "0";
	} else {
		$cntfin = $result2['result_count'];
	}
	$total = floor(($maxplr - $cntfin)/10);

	if($cntfin == "0") {
		$plr = "0";
	}else if(empty($cntfin)) {
		$plr = "0";
	} else {
		$plr = $cntfin;
	}

	$final = '
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				    <td height="10px" align=center><div class="status"><a href=?pageid=status&id='.$id.' style="text-decoration:none">'.$name.'</a></div></td>
				</tr>
				<tr>
					<td><table width="100px" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="10px" width="'.$$cntfin.'" style="background-image:url(includes/images/status/bar2.png)"></td>
					<td height="10px" width="'.$total.'" style="background-image:url(includes/images/status/bar.png)"></td>
				</tr>
			</table></td>
				</tr>
				<tr>
					<td height="10px" align=center><center> <font style="font-size:9px; font-family:Tahoma, Geneva, sans-serif">('.$plr.' / '.$maxplr.' ) '.players_online.'</font></center><br /></td>
				</tr>  
			</table>
		';
	return $final;
	$sql->close();
}
?>
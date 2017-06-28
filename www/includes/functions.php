<?php

class Utils{

	public static function checkLogin() {
		if(!isset($_SESSION['admin_id'])) {
			static::redirect("admin_login.php", "");
		}
	}


	public static function displayError($key, $arr) {
		if(isset($arr[$key])) {
			echo '<span class="err">'.$arr[$key]. '</span>';
		}

	}

	public static function redirect($loc, $msg) {
		header("Location: ".$loc.$msg);
	}

	public static function doLogin($dbconn, $input) {
		$result = [];

		$stmt = $dbconn->prepare("SELECT admin_id, hash FROM admin WHERE email=:e");
		$stmt->bindParam(":e", $input['email']);

		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_BOTH);

		# if either the email or password is wrong, we return a false array
		if( ($stmt->rowCount() != 1) || !password_verify($input['password'], $row['hash']) ) {

		Utils::redirect("admin_login.php? +msg=", "either username or password is incorrect");
			exit();
		} else {
			# return true plus extra information...
			$result[] = true;
			$result[] = $row['admin_id'];
		}

		return $result;
	}


	public static function doRegistration($dbconn, $input) {
		$stmt = $dbconn->prepare("INSERT INTO admin(firstname, lastname, email, hash) 
				VALUES(:fn, :ln, :e, :h)");

		$data = [
			":fn" => $input['fname'],
			":ln" => $input['lname'],
			":e" => $input['email'],
			":h" => $input['password']
		];

		$stmt->execute($data);
	} 


	public static function doesEmailExist($dbconn, $email) {
		$result = false;

		$stmt = $dbconn->prepare("SELECT * FROM admin WHERE email=:e");
		$stmt->bindParam(":e", $email); 

		$stmt->execute();

		# count result set
		$count = $stmt->rowCount();

		if($count > 0) { $result = true; }

		return $result;
	}


}

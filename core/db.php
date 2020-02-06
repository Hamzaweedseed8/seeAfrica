<?php
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'seeafrica');
	if(mysqli_connect_error()){
		echo 'Database connection failed with the following errors: '. mysqli_connect_error();
		die();
	}
	function login($user_id){
		$_SESSION['access_token'] = $user_id;
	}
	function sanitize($dirty){
		global $db;
		$dirty = htmlspecialchars($dirty);
		$dirty = mysqli_real_escape_string($db, $dirty);
		return htmlentities($dirty,ENT_QUOTES, "UTF-8");
	}

	function generateRandomString($length = 20) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
    	return md5($randomString);
	}


	
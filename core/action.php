<?php 
require 'db.php';
if(isset($_POST["userLogin"])){
	$email = ((isset($_POST['email'])) ? sanitize($_POST['email']) : '');
	$email = trim($email);
    
	$password = ((isset($_POST['password'])) ? sanitize($_POST['password']) : '');
	$password = trim($password);
    
    if(empty($_POST['email']) || empty($_POST['password'])){
		echo "<p class='error_msg'>You must provide Email and Password.</p>";
       	die();
	}

    //validate email
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo "<p class='error_msg'>".$email ." is not  a valid email.</p>";
       	die();
	}

	//check if email exists in the databese
		$query = $db->query("SELECT * FROM users WHERE email = '$email'");
		$user = mysqli_fetch_assoc($query);
		$userCount = mysqli_num_rows($query); 
	
		if($userCount < 1){
			echo "<p class='error_msg'>Wrong email or password.</p>";
       		die();
		}
        if($user['active'] != 1){
		    echo "<p class='error_msg'>Your account is not activated, please use the link that has been send to your email. Or <a href='resend'>Resend link</a></p>";
       		    die();
		}
		if(!password_verify($password, $user['password'])){
			echo "<p class='error_msg'>Wrong email or password.</p>";
       		die();
		}
		$user_id = $user['id'];
		login($user_id);
		echo "?$#";
		
	}


?>
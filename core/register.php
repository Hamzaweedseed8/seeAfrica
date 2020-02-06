<?php 


	require_once 'db.php';
	$name = ((isset($_POST['name']))?sanitize($_POST['name']):'');

    $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');

    $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');

    $confirm = ((isset($_POST['confirmpassword']))?sanitize($_POST['confirmpassword']):'');
    
    // $confirm = $password;

    if($_POST){
        //requirement of all inputs
        $required = array('name', 'email', 'password', 'confirmpassword');
        foreach ($required as  $f) {
            if(empty($_POST[$f])){
                echo "<p class='error_msg'>You must fill out all fields.</p>";
                exit();
                break;
            }
        }

        //check if the emial Already exist
        $emailQuery = $db->query("SELECT * FROM users WHERE email = '$email' ");
        $emailCount = mysqli_num_rows($emailQuery);
        if($emailCount != 0){
            echo "<p class='error_msg'>That Email already in used.</p>";
            exit();
        }
       	
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            echo "<p class='error_msg'>You must enter a valid Email.</p>";
            exit();
        }   

		//password should not be less than 8
        if(strlen($password) < 8){
            echo "<p class='error_msg'>Your Password must be at least 8 characters.</p>";
            exit();
        }
        //password should not bel less than 8
        if(strlen($confirm) < 8){
            echo "<p class='error_msg'>Your Password must be at least 8 characters.</p>";
            exit();
        }

        //If password are not the same
        if($password != $confirm){
            echo "<p class='error_msg'>Your Passwords do not match.</p>";
              exit();
		}

        $hashed = password_hash($password,PASSWORD_DEFAULT);
        $hash = generateRandomString();
        $link = 'http://localhost/public_html/operators/verify.php?email='.$email.'&hash='.$hash;
        $message = '
            Thanks for signing up! account has been created, you can login with the following credentials after you have activated account by pressing the url below.
            Please click this link to activate account:
            <a href='.$link.'>verify</a> ';
        $mail = mail($email, "seeAfrica",$message,"From: info@seeafrica.com");
        if ($mail) {
        //     echo "<p class='error_msg'> email not sent.</p>";
        //     exit();
        // }else{
            $sql="INSERT INTO users (fullname,email,password,hash) VALUES ('$name','$email','$hashed','$hash')";
            $query= $db->query($sql);
            if($query){
                echo "<p class='success_msg'> Your Registeration has been successful.<br> Please check your email to verify your account .</p>";
            }else{
                echo "eror ". mysqli_error($db);
            }
        }
    }
?>
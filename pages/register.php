<?php
//Search user details 
	$query = "SELECT * FROM users WHERE user_email = :useremail";
	    $result = $DBH->prepare($query);
	    $result->bindParam(':useremail', $_POST['email']);
	    $result->execute();
	    $userProfile = $result->fetch(PDO::FETCH_ASSOC);
	    
	if(isset($_POST['email']) || isset($_POST['password'])|| isset($_POST['username'])|| isset($_POST['mobile'])){
	
        if(!$_POST['email'] || !$_POST['password'] || !$_POST ['username']){
	       $error = "Please enter an username, email and password";
        }else  if(strlen($_POST ['username']) < 6 ) {
	       $error = "* Username has at least 6 char!";
	   }else  if(strlen($_POST ['password']) < 6 ) {
	       $error = "* Password has at least 6 char!";
	   }else if($userProfile['user_email']==$_POST['email']){
                $error = "* This email has been used!";
	   }else if($_POST['mobile']){
            if(strlen($_POST ['mobile']) !==11){
		          $error = "* phone is not 11 number!";
            }
       }else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
             $error = "Invalid email format"; 
	   }
        if(!$error ){
            //No errors - let’s create the account
            //Encrypt the password with a salt
            $encryptedPass = password_hash($_POST['password'], PASSWORD_DEFAULT);
            //Insert DB
            $query = "INSERT INTO users (user_name, user_email, user_password) VALUES (:username, :email, :password)";
            $result = $DBH->prepare($query);
            $result->bindParam(':username', $_POST['username']);
            $result->bindParam(':email', $_POST['email']);
            $result->bindParam(':password', $encryptedPass);
            $result->execute();
            
            
            $to = $_POST['email'];
            
            $subject = "Welcome to our Restaurant Review Application";

            $message = "
            <html>
            <head>
            <title>Welcome to our Restaurant Review Application</title>
            </head>
            <body>
            <p>Welcome to our Restaurant Review Application!</p>
            </body>
            </html>";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <xiez1_16@uni.worc.ac.uk>' . "\r\n";

            mail($to,$subject,$message,$headers);
		// Textlocal account details
		$username = 'xiez1_16@uni.worc.ac.uk';
		//$hash = '3e5df8e85a7909b81b42b062f331ba54a5d1d5c4';
		$hash = '3e5df8e85a7909b81b42b062f331ba54a5d1d5c4';
		// Message details
		$numbers = $_POST['mobile'];
		$sender = urlencode('Restaurant Review Application');
		$message = rawurlencode('Welcome to Restaurant Review Application!');
		
		// Prepare data for POST request
		$data = array('username' => $username, 'hash' => $hash, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
		
		// Send the POST request with cURL
		$ch = curl_init('http://api.txtlocal.com/send/');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
            echo "<script> window.location.assign('index.php?p=registersuccess'); </script>";
        }
     
	}

?>

<div class="container">
    <h1>Register</h1>
	<form action="index.php?p=register" method="post">
            <?php if($error){
            echo '<div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>  '.$error.'  </div>';
            } ?>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" class="form-control" id="username" name="username" placeholder="username">
		</div>
		<div class="form-group">
			<label for="email">Email address</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="email">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="password">
		</div>
		<div class="form-group">
			<label for="text">Mobile Number(can be empty)</label>
			<input type="text" class="form-control" id="mobile" name="mobile" placeholder="01234123123">
		</div>
		<button type="submit" class="btn btn-default" id="register" >Register</button>
	</form>
</div>
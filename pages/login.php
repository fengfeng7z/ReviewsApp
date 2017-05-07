<?php

if(isset($_POST['email']) || isset($_POST['password'])){
	if(!$_POST['email'] || !$_POST['password']){
		$error = "Please enter an email and password";
	}

	if(!$error){
		//No errors - lets get the users account
$query = "SELECT * FROM users WHERE user_email = :email";
		$result = $DBH->prepare($query);
		$result->bindParam(':email', $_POST['email']);
		$result->execute();

		$row = $result->fetch(PDO::FETCH_ASSOC);

		if($row){
		    	//User found - let's check the password
			if(password_verify($_POST['password'], $row['user_password'])){
				$_SESSION['loggedin'] = true;
		    		$_SESSION['userData'] = $row;

		    		echo "<script> window.location.assign('index.php?p=list'); </script>";
			}else{
					$error = "Username/Password Incorrect";
			}
		    	
		}else{
		    	$error = "Username/Password Incorrect";
		}

}
}

?>

<div class="container">
<h1>Login</h1>
	<form action="index.php?p=login" method="post">
<?php if($error){
	//If error, show error information
		echo '<div class="alert alert-danger" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span class="sr-only">Error:</span>
		'.$error.'
		</div>'; 
	} ?>
		<div class="form-group">
			<label for="email">Email address</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="email">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="password">
		</div>
		<button type="submit" class="btn btn-default">Login</button>
	</form>
</div>

<?php
	if(!$_SESSION['loggedin']){
		//User is not logged in
		echo "<h1>Access Denied</h1>";
		echo "<script> window.location.assign('index.php?p=login'); </script>";
		exit;
	}
?>
<div class="container">
	<h1>Edit your profile</h1>
	<p>Complete the form below to edit your public profile.</p>

	<!-- Form here -->
    <?php

		if(isset($_POST['submit'])){
			//Upload Image Here
            		if($_FILES['profile_image']["tmp_name"]){
				//Let's add a random string of numbers to the start of the filename to make it unique!
				$newFilename = md5(uniqid(rand(), true)).$_FILES["profile_image"]["name"];
				$target_file = "./user_images/" . basename($newFilename);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
				    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
				    if($check === false) {
				        echo '<div class="alert alert-danger" role="alert">File is not an image!</div>';
				        $uploadError = true;
				    }
	
				    //Check file already exists - It really, really shouldn't!
					else if (file_exists($target_file)) {
						echo '<div class="alert alert-danger" role="alert">Sorry, file already exists.</div>';
						$uploadError = true;
					}

					// Check file size
					else if ($_FILES["profile_image"]["size"] > 2000000) {
					    echo '<div class="alert alert-danger" role="alert">Sorry, your file is too large.</div>';
					    $uploadError = true;
					}

				// Allow certain file formats
					else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
					    echo '<div class="alert alert-danger" role="alert">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>';
					    $uploadError = true;
					}

				// Did we hit an error?
					if ($uploadError ) {
					    echo '<div class="alert alert-danger" role="alert">Sorry, your photo was not uploaded.</div>';
					} else {
					//Save file
						    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
						        //Success!
						    } else {
						        echo '<div class="alert alert-danger" role="alert">Sorry, there was an error uploading your file.</div>';
						    }
					}
			}else{
				$target_file =null;
			}
			//If file exist and no error
            if($target_file&&!$uploadError ){
				$query = "UPDATE users SET user_name = :forename, location = :location, favorite_food=:favorite_food, favorite_restaurant=:favorite_restaurant, county=:county, user_email = :email, gender = :gender, profile_image = :profile_image WHERE user_id = :userid";
			}else{
				$query = "UPDATE users SET user_name = :forename, location = :location, favorite_food=:favorite_food, favorite_restaurant=:favorite_restaurant, county=:county, user_email = :email, gender = :gender WHERE user_id = :userid";
			} 
		    $result = $DBH->prepare($query);
		    $result->bindParam(':forename', $_POST['name']);
		    $result->bindParam(':location', $_POST['location']);
		    $result->bindParam(':favorite_restaurant', $_POST['favorite_restaurant']);
		    $result->bindParam(':county', $_POST['county']);
		    $result->bindParam(':favorite_food', $_POST['favorite_food']);
		    $result->bindParam(':email', $_POST['email']);
		    $result->bindParam(':gender', $_POST['gender']);
		    if($target_file&&!$uploadError ){
				$result->bindParam(':profile_image', $newFilename);
			}else{	}
		    $result->bindParam(':userid', $_SESSION['userData']['user_id']);
		    if($result->execute()){
		    	echo '<p class="bg-success">Your profile has been updated!</p>';
		    	if(!$uploadError){
		    		//Go to page viewprofile
                		echo "<script> window.location.assign('index.php?p=viewprofile&id=".$_SESSION['userData']['user_id']."'); </script>";
                	}
		    }
		}

		//Get current values
		$query = "SELECT * FROM users WHERE user_id = :userid";
	    $result = $DBH->prepare($query);
	    $result->bindParam(':userid', $_SESSION['userData']['user_id']);
	    $result->execute();

	    $userProfile = $result->fetch(PDO::FETCH_ASSOC);
	    //Updata SESSION
	    $_SESSION['userData'] = $userProfile;
?>



	<form method="post" action="" enctype="multipart/form-data">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" value="<?php echo $userProfile['user_name']; ?>">
		</div>
		<div class="form-group">
			<label for="profile_image">Profile Photo</label>
			<input type="file" name="profile_image" id="profile_image">
			<input type="text" class="form-control" disabled="disabled" id="img" name="img" value="<?php echo $userProfile['profile_image']; ?>">
			<p class="help-block">Upload a photo of yourself for your profile.</p>
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" class="form-control" id="email" name="email" value="<?php echo $userProfile['user_email']; ?>">
		</div>
		<div class="form-group">
			<label for="gender">Gender</label>
			<input type="text" class="form-control" id="gender" name="gender" value="<?php echo $userProfile['gender']; ?>">
		</div>
		<div class="form-group">
			<label for="favorite_food">Favorite food</label>
			<input type="text" class="form-control" id="favorite_food" name="favorite_food" value="<?php echo $userProfile['favorite_food']; ?>">
		</div>
		<div class="form-group">
			<label for="favorite_restaurant">Favorite restaurant</label>
			<input type="text" class="form-control" id="favorite_restaurant" name="favorite_restaurant" value="<?php echo $userProfile['favorite_restaurant']; ?>">
		</div>
		<div class="form-group">
			<label for="county">county</label>
			<input type="text" class="form-control" id="county" name="county" value="<?php echo $userProfile['county']; ?>">
		</div>
		<div class="form-group">
			<label for="location">Location</label>
			<input type="text" class="form-control" id="location" name="location" value="<?php echo $userProfile['location']; ?>">
		</div>
		
		<button type="submit" name="submit" class="btn btn-default">Update Profile</button>
	</form>
</div>


			
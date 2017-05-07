<?php
	if(!$_SESSION['loggedin']){
		//User is not logged in
		echo "<h1>Access Denied</h1>";
		echo "<script> window.location.assign('index.php?p=login'); </script>";
		exit;
	}
?>

<div class="mainContainer">

	
	<!-- User info here -->
	<center id="profilelist">
    <h1><?php echo $_SESSION['userData']['user_name']; ?></h1>

    <img class="profileImage" src="./user_images/<?php echo $_SESSION['userData']['profile_image']; ?>"/>
	<p><strong>Email:</strong> <?php echo $_SESSION['userData']['user_email']; ?></p>
    <p><strong>Gender:</strong> <?php echo $_SESSION['userData']['gender']; ?></p>
    <p><strong>Favorite Food:</strong> <?php echo $_SESSION['userData']['favorite_food']; ?></p>
	<p><strong>Favorite Restaurant:</strong> <?php echo $_SESSION['userData']['favorite_restaurant']; ?></p>
	<p><strong>County:</strong> <?php echo $_SESSION['userData']['county']; ?></p>
    <p><strong>Location:</strong> <?php echo $_SESSION['userData']['location']; ?></p>
	</center>
 
</div>
    
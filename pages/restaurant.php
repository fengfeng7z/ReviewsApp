<?php
	if(!$_SESSION['loggedin']){
		//User is not logged in
		echo "<h1>Access Denied</h1>";
		echo "<script> window.location.assign('index.php?p=login'); </script>";
		exit;
	}else if (!$_GET['id']) {
		echo "<script> window.location.assign('index.php?p=list'); </script>";
	}
?>

<script src="js/restaurant.js"> </script>
<?php
if($_GET['id']){
	//Get restaurant details
    $query = "SELECT * FROM restaurants WHERE restaurant_id = :restaurantid";
    $result = $DBH->prepare($query);
    $result->bindParam(':restaurantid', $_GET['id']);
    $result->execute();
    $restaurant = $result->fetch(PDO::FETCH_ASSOC);
	//Get review details
    $query2 = "SELECT * FROM reviews WHERE restaurant_id = :restaurantid";
    $result2 = $DBH->prepare($query2);
    $result2->bindParam(':restaurantid', $_GET['id']);
    $result2->execute();
    $review = $result2->fetch(PDO::FETCH_ASSOC);
}else{
	//Display error
	$error = "No restaurant id defined.";
}

	// Get average rating
	$query5 = "SELECT AVG(star) AS score_average FROM reviews WHERE restaurant_id = :restaurantid";
	$result5 = $DBH->prepare($query5);
	$result5->bindParam(':restaurantid',  $_GET['id']);
	$result5->execute();
	$reviewData = $result5->fetch(PDO::FETCH_ASSOC);
							
?>

    <div class="mainContainer">
	  	  <div id="RestaurantPageList">
	  	  	<center><h1><?php echo $restaurant['restaurant_name'];?></h1></center>
	  	  	<p id="Ave"><?php echo "Average Rating: ".round($reviewData['score_average'], 0);?></p>
	  	  	<div class="informationTable" id="Restaurant_List"> 
				        <div>
				        	<div style="height:400px;"><img class="restaurantImage" src="./restaurant_images/<?php echo $restaurant['img']; ?>"/>
				        		
 				 	 					<div id="map"></div> 
   										 <input type="hidden" class="form-control" id="defaultLat" value="<?php echo $restaurant['defaultLat'];?>"> 
				        				<input type="hidden" class="form-control" id="defaultLng" value="<?php echo $restaurant['defaultLng'];?>"> 
				        	</div>
				        	<div id="introduction" style="clear: both;"><p><?php echo "Introduction: ".$restaurant['introduction'];?></p>
				        	<br>
				        	<p><?php echo "Location: ".$restaurant['restaurant_location'];?></p></div>
				        	
				        	<hr>
				        	<div style="clear: both;"></div>
				        </div>
		        	
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQYIgys19VrvitITU2xmd7PUn9aGsr3Ac&libraries=places"></script>
      <script src="js/map.js"></script>
				        <?php
				       
				        while($review = $result2->fetch(PDO::FETCH_ASSOC)){
				        //Get user details
				    $query3 = "SELECT * FROM users WHERE user_id= :userid";
				    $result3 = $DBH->prepare($query3);
				    $result3->bindParam(':userid', $review['user_id']);
				    $result3->execute();
				    $user = $result3->fetch(PDO::FETCH_ASSOC);
				        ?>
				        <div>
				            <div class="userImg" ><img class="profileImage" src="./user_images/<?php echo $user['profile_image']; ?>"/><br><p><?php echo "User".$user['user_id'].":",$user['user_name']; ?></p></div>
				        	<div class="userCommet"><?php echo "<h2>Score:".$review['star']."</h2>".$review['comment']; ?></div>
				        	<div style="clear: both;"></div>
				        </div>	
			   
				     
				<?php
				        }
				    ?>
			</div>	
		        <div  class="informationTable">	
		      		<div >	
		           
		            
		        		<div>
		        	
		        	
		        			<form class="form-inline">
		        			 <div class="userImg"><img class="profileImage" src="./user_images/<?php echo $_SESSION['userData']['profile_image']; ?>"/><br><?php echo "User".$_SESSION['userData']['user_id'].":",$_SESSION['userData']['user_name']; ?></div>
		        			 <div  class="myComment">
			       					 <div class="form-group">
			      					<input type="text"   id="comment" placeholder="Say something" width=800px height=100px>
			  					  </div>
		  	  					<input type="hidden" class="form-control" id="restaurantid" value="<?php echo $_GET['id'];?>"> 
		  	  					<input type="hidden" class="form-control" id="img" value="<?php echo $_SESSION['userData']['profile_image'];?>"> 
		  	  					<input type="hidden" class="form-control" id="userid" value="<?php echo $_SESSION['userData']['user_id'];?>">
		  	  					<input type="hidden" class="form-control" id="username" value="<?php echo $_SESSION['userData']['user_name'];?>">
				  			  	<div class="review-form-container">
								
							
									<form class="form-inline" method="post" action="#">
										<div class="form-group">
											<select name="review_rating" id="rating" class="form-control">
												<option value="1">1 Star</option>
												<option value="2">2 Star</option>
												<option value="3">3 Star</option>
												<option value="4">4 Star</option>
												<option value="5">5 Star</option>
												<option value="6">6 Star</option>
												<option value="7">7 Star</option>
												<option value="8">8 Star</option>
												<option value="9">9 Star</option>
												<option value="10">10 Star</option>
											</select>
										</div>
										
									</form>
									
							
							
								  </div>
		  	  			
		  	  			
		          					<button type="button" class="btn btn-primary" id="addcomment" float="right">Submit<span class="glyphicon " aria-hidden="true" ></span></button>
			      			</div>	
			        		</form>
			       		 </div>
		        		<div style="clear: both;"></div>
		        	
		       		 </div>	
	        	 </div> 
		  </div>
      
 </div>
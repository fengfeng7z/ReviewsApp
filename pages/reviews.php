<?php
	if(!$_SESSION['loggedin']){
		//User is not logged in
		echo "<h1>Access Denied</h1>";
		echo "<script> window.location.assign('index.php?p=login'); </script>";
		exit;
	}
?>

<script src="js/review.js"> </script>
    <div class="mainContainer">
  	  <ul id="ReviewList">
  	  	<h1>My Reviews</h1>
  	  	<form class="form-inline" action="" method="post" >
		<div class="form-group">
			<input type="text" class="form-control" id="search" name="search" placeholder="Search Restaurant">
		</div>
		<button type="submit" class="btn btn-primary" float=left>Search</button>
	</form>
  	  	<table class="reviewTable"> 
        <tr>
        	<th><h2>NO.</h2></th>
        	<th><h2>Restaurants</h2></th>
        	<th><h2>Reviews</h2></th>
        </tr>	
        	<?php
        	try{
        			//Search review's details in database
        			if(isset($_POST['search'])){
        			$search = '%'.$_POST['search'].'%';
        			$query="SELECT * FROM reviews WHERE user_id=:userid AND comment LIKE :search";
		        	$pdo=$DBH->prepare($query);
		        	$pdo->bindParam(':userid',$_SESSION['userData']['user_id'] );
		        	$pdo->bindParam(':search',$search);
		        	$pdo->execute();
        			}else{
		        	$query="SELECT * FROM reviews WHERE user_id=:userid";
		        	$pdo=$DBH->prepare($query);
		        	$pdo->bindParam(':userid',$_SESSION['userData']['user_id'] );
		        	$pdo->execute();
		        	}
		        	
		        	$i=1;
		        	
		        	while($row=$pdo->fetch(PDO::FETCH_ASSOC)){
		        	?>
		        	<tr>
		        		<li>
		        		<td><?php echo $i,". ";  ?></td>
		        		<td><?php  
		        			//Search restaurant's details
		        		$query2="SELECT * FROM restaurants WHERE restaurant_id=:restaurantid";
		        		$result=$DBH->prepare($query2);
		        		$result->bindParam(':restaurantid',$row['restaurant_id'] );
		        		$result->execute();
		        		$row2=$result->fetch(PDO::FETCH_ASSOC);
		        		echo "".$row2['restaurant_name']." ";
		        		 ?></td>
		        		<td><?php  echo "".$row['comment']."<span data-reviewid=\"".$row['review_id']."\" class=\"glyphicon glyphicon-remove deleteReview\"></span>"; ?></td>
		        	</li>
		        	</tr>
		        	<?php
		        	$i++;
		        	}
      		}catch(Exception $exception){
       				echo $exception->getMessage();
      		}
      			 ?>
        
        
        </table>
	   </ul>
      
	 </div>
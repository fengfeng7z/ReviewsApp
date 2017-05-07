<?php
	if(!$_SESSION['loggedin']){
		//User is not logged in
		echo "<h1>Access Denied</h1>";
		echo "<script> window.location.assign('index.php?p=login'); </script>";
		exit;
	}
	$typeR=1;
?>


    <div class="mainContainer">
  	  <ul id="RestaurantList">
  	  	<h1>Restaurant List</h1>
  	  	<p  ><?php 
  	  		//Set Category tips
  	  		if($_GET['listid']){
		      
		        	if($_GET['listid']==1){
		        		echo "All Restaurant";
		        		}
		        		  if($_GET['listid']==2){
		        		echo "English Restaurants";
		        		}
		        		 if($_GET['listid']==3){
		        		echo "Chinese Restaurants";
		        		}
		        		  	if($_GET['listid']==4){
		        		echo "Indian Restaurants";
		        		}
		        		 if($_GET['listid']==5){
		        		echo "French Restaurants";
		        		}
		        	} ?></p>
  	  	<form class="form-inline" action="" method="post" >
		<div class="form-group">
			<input type="text" class="form-control" id="search" name="search" placeholder="Search Restaurant">
		</div>
		<button type="submit" class="btn btn-primary" float=left>Search</button>
					
			<div class="dropdown" style="float:right;">
				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Category<span class="caret"></span></button>
  					<ul class="dropdown-menu">
    						<li><a href="index.php?p=list&listid=1">All Restaurant</a></li>
    						<li><a href="index.php?p=list&listid=2">English Restaurants</a></li>
   					<li>	<a href="index.php?p=list&listid=3">Chinese Restaurants</a></li>
   					<li>	<a href="index.php?p=list&listid=4">Indian Restaurants</a></li>
   						<li><a href="index.php?p=list&listid=5">French Restaurants</a></li>
  					</ul>
  			</div>

	</form>

  	  	<table class="listTable">
        <tr>
        	<th><h2>NO.</h2></th>
        	<th><h2>Restaurant</h2></th>
        	<th><h2>Location</h2></th>
        </tr>	
        	<?php
        	try{
        		
        			//Prepare restaurant details for defferent categories
        			if(($_POST['search'])){
        			$search = '%'.$_POST['search'].'%';
        			$query="SELECT * FROM restaurants WHERE restaurant_name LIKE :search";
        			$query1="SELECT * FROM restaurants WHERE restaurant_name LIKE :search AND listid=1";
        			$query2="SELECT * FROM restaurants WHERE restaurant_name LIKE :search AND listid=2";
        			$query3="SELECT * FROM restaurants WHERE restaurant_name LIKE :search AND listid=3";
        			$query4="SELECT * FROM restaurants WHERE restaurant_name LIKE :search AND listid=4";
		        	$pdo=$DBH->prepare($query);
		        	$pdo1=$DBH->prepare($query1);
		        	$pdo2=$DBH->prepare($query2);
		        	$pdo3=$DBH->prepare($query3);
		        	$pdo4=$DBH->prepare($query4);
		        	$pdo->bindParam(':search',$search);
		        	$pdo1->bindParam(':search',$search);
		        	$pdo2->bindParam(':search',$search);
		        	$pdo3->bindParam(':search',$search);
		        	$pdo4->bindParam(':search',$search);
		        	$pdo->execute();
		        	$pdo1->execute();
		        	$pdo2->execute();
		        	$pdo3->execute();
		        	$pdo4->execute();
        			}else{
		        	$query="SELECT * FROM restaurants ";
		        	$query1="SELECT * FROM restaurants WHERE listid=1";
		        	$query2="SELECT * FROM restaurants WHERE listid=2";
		        	$query3="SELECT * FROM restaurants WHERE listid=3";
		        	$query4="SELECT * FROM restaurants WHERE listid=4";
		        	$pdo=$DBH->prepare($query);
		        	$pdo1=$DBH->prepare($query1);
		        	$pdo2=$DBH->prepare($query2);
		        	$pdo3=$DBH->prepare($query3);
		        	$pdo4=$DBH->prepare($query4);
		        	$pdo->execute();
		        	$pdo1->execute();
		        	$pdo2->execute();
		        	$pdo3->execute();
		        	$pdo4->execute();
		        }
		        
		    if($_GET['listid']){
		      //According to the listid posted, show the list
		        	if($_GET['listid']==1){
		        		$pdo5=$pdo;
		        		}
		        		  if($_GET['listid']==2){
		        		$pdo5=$pdo1;
		        		}
		        		 if($_GET['listid']==3){
		        		$pdo5=$pdo2;
		        		}
		        		  	if($_GET['listid']==4){
		        		$pdo5=$pdo3;
		        		}
		        		 if($_GET['listid']==5){
		        		$pdo5=$pdo4;
		        		}
		        	}else {
		        	 	$pdo5=$pdo;
		        	}
		        	$i=1;
		        	//Show each category list of restaurant
		        	while($row=$pdo5->fetch(PDO::FETCH_ASSOC)){
		        	?>
		        	<tr>
		        		<td><?php echo $i,". ";  ?></td>
		        		<td><?php  echo'<a href="index.php?p=restaurant&id='.$row[restaurant_id].'">', $row['restaurant_name'],"</a>" ; ?></td>
		        		<td><?php  echo $row['restaurant_location'];?></td>
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
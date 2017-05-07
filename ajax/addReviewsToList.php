<?php 
	require_once('../includes/db.php');
	//$_POST['listid']=1;
	//$_POST['itemName']="Bread & Butter";
	if(!empty($_POST['comment'])&&!empty($_POST['star'])){
		if($_POST['restaurantid'] && $_POST['comment']&& $_POST['star']){
		$query= "INSERT INTO reviews (restaurant_id, user_id, comment, star) VALUES (:restaurantid, :userid, :comment, :star)";
		$result= $DBH->prepare($query);
		$result->bindParam(':restaurantid',$_POST['restaurantid']);
		$result->bindParam(':userid',$_SESSION['userData']['user_id']);
		$result->bindParam(':comment',$_POST['comment']);
		$result->bindParam(':star',$_POST['star']);
		if($result->execute()){
									
									//echo $DBH->lastInsertId();
								}
		
		}
		
	}
?>

<?php
require_once('../includes/db.php');


if($_POST['reviewid']){
$query = "DELETE FROM reviews WHERE review_id = :reviewid";
$result = $DBH->prepare($query);
$result->bindParam(':reviewid', $_POST['reviewid']);
$result->execute();

echo "Done - Magic!";
}
?>

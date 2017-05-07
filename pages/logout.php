<?php
	//Remove all Global Variables
	$_SESSION = [];
	//Destroy Session
	session_destroy();
	echo "<script> window.location.assign('index.php?p=login'); </script>";
?>

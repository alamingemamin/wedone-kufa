<?php
session_start();
include "../auth_check.php";
include "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$update_sql   = "DELETE FROM services WHERE id='$id'";
	$update_query = mysqli_query($connect,$update_sql);
	
	if ($update_query) {
		$_SESSION['success'] = "Your service has been deleted successfully";
		header("location: service-list.php");
	}else{
		$_SESSION['error'] = "Your service has not deleted";
		header("location: service-list.php");
	}
	
}else{
  header("location: service-list.php");
}




?>
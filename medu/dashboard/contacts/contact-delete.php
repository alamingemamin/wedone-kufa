<?php
session_start();
include "../auth_check.php";
include "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$delete_sql   = "DELETE FROM contacts WHERE id='$id'";
	$delete_query = mysqli_query($connect,$delete_sql);
	
	if ($delete_query) {
		$_SESSION['success'] = "Your contact has been deleted successfully";
		header("location: contact-list.php");
	}else{
		$_SESSION['error'] = "Your contact has not deleted";
		header("location: contact-list.php");
	}
	
}else{
  header("location: contact-list.php");
}




?>
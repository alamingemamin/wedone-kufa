<?php
session_start();
include "../auth_check.php";
include "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$delete_sql   = "DELETE FROM educations WHERE id='$id'";
	$delete_query = mysqli_query($connect,$delete_sql);
	
	if ($delete_query) {
		$_SESSION['success'] = "Your education has been deleted successfully";
		header("location: education-list.php");
	}else{
		$_SESSION['error'] = "Your education has not deleted";
		header("location: education-list.php");
	}
	
}else{
  header("location: education-list.php");
}




?>
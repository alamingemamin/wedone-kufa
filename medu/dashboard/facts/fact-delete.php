<?php
session_start();
include "../auth_check.php";
include "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$delete_sql   = "DELETE FROM facts WHERE id='$id'";
	$delete_query = mysqli_query($connect,$delete_sql);
	
	if ($delete_query) {
		$_SESSION['success'] = "Your fact has been deleted successfully";
		header("location: fact-list.php");
	}else{
		$_SESSION['error'] = "Your fact has not deleted";
		header("location: fact-list.php");
	}
	
}else{
  header("location: fact-list.php");
}




?>
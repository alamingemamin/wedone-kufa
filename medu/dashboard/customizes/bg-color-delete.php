<?php
session_start();
include "../auth_check.php";
include "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$delete_sql   = "DELETE FROM customizes  WHERE id='$id'";
	$delete_query = mysqli_query($connect,$delete_sql);
	
	if ($delete_query) {
		$_SESSION['success'] = "Bg color has been deleted successfully";
		header("location: bg-color-list.php");
	}else{
		$_SESSION['error'] = "Bg color has not delete";
		header("location: bg-color-list.php");
	}
	
}else{
  header("location: bg-color-list.php");
}




?>
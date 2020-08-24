<?php
session_start();
include "../auth_check.php";
include "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$update_sql   = "UPDATE contacts SET status='0' WHERE id='$id'";
	$update_query = mysqli_query($connect,$update_sql);
	
	if ($update_query) {
		header("location: contact-list.php");
	}else{
		header("location: contact-list.php");
	}
	
}else{
  header("location: contact-list.php");
}




?>
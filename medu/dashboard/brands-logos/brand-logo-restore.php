<?php

session_start();

include '../auth_check.php';
include '../../includes/database.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$update_trash = "UPDATE brands_logo SET deleted='0' WHERE id='$id'";
	$update_query  = mysqli_query($connect,$update_trash);
	if ($update_query) {
		$_SESSION['success'] = "Brand logo restore has been successfully";
		header("location: brands-logos-list.php");
	}else{
		$_SESSION['error'] = "Something went to wrong";
		header("location: brands-logos-list.php");
	}
}else{
	header("location: brands-logos-list.php");
}

?>
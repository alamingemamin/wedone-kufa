<?php

session_start();

include '../auth_check.php';
include '../../includes/database.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$update_trash = "UPDATE photos SET deleted='1' WHERE id='$id'";
	$update_query  = mysqli_query($connect,$update_trash);
	if ($update_query) {
		$_SESSION['success'] = "photo move to trash has been successfully &nbsp <a href='photo-restore.php?id=$id' class='btn btn-info btn-sm'>Undo</a>";
		header("location: photo-list.php");
	}else{
		$_SESSION['error'] = "Something went to wrong";
		header("location: photo-list.php");
	}
}else{
	header("location: photo-list.php");
}

?>
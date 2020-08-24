<?php

session_start();

include '../auth_check.php';
include '../../includes/database.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$filename = $_GET['file_name'];
	if (unlink('../../uploads/photos/'.$filename)) {
		$delete_photo = "DELETE FROM photos WHERE id='$id'";
		$delete_query  = mysqli_query($connect,$delete_photo);

		if ($delete_query) {
			$_SESSION['success'] = "photo has been permanently deleted successfully";
			header("location: photo-list.php");
		}else{
			$_SESSION['error'] = "Something went to wrong";
			header("location: photo-list.php");
		}
	}else{
		$_SESSION['error'] = "photo file does not delete!!!";
		header("location: photo-list.php");
	}
	
}else{
	header("location: photo-list.php");
}

?>
<?php

session_start();

include '../auth_check.php';
include '../../includes/database.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$filename = $_GET['file_name'];
	if (unlink('../../uploads/logos/'.$filename)) {
		$delete_logo = "DELETE FROM logos WHERE id='$id'";
		$delete_query  = mysqli_query($connect,$delete_logo);

		if ($delete_query) {
			$_SESSION['success'] = "Logo has been permanently deleted successfully";
			header("location: logos-list.php");
		}else{
			$_SESSION['error'] = "Something went to wrong";
			header("location: logos-list.php");
		}
	}else{
		$_SESSION['error'] = "Logo file does not delete!!!";
		header("location: logos-list.php");
	}
	
}else{
	header("location: logos-list.php");
}

?>
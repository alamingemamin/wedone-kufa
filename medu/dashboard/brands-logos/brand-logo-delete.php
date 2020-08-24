<?php

session_start();

include '../auth_check.php';
include '../../includes/database.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$filename = $_GET['file_name'];
	if (unlink('../../uploads/brand-logos/'.$filename)) {
		$delete_brand_logo = "DELETE FROM brands_logo WHERE id='$id'";
		$delete_query  = mysqli_query($connect,$delete_brand_logo);

		if ($delete_query) {
			$_SESSION['success'] = "Brand Logo has been permanently deleted successfully";
			header("location: brands-logos-list.php");
		}else{
			$_SESSION['error'] = "Something went to wrong";
			header("location: brands-logos-list.php");
		}
	}else{
		$_SESSION['error'] = "Logo file does not delete!!!";
		header("location: brands-logos-list.php");
	}
	
}else{
	header("location: brands-logos-list.php");
}

?>
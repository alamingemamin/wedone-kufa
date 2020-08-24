<?php

session_start();

include '../auth_check.php';
include '../../includes/database.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];

		$delete_about = "DELETE FROM abouts WHERE id='$id'";
		$delete_query  = mysqli_query($connect,$delete_about);

		if ($delete_query) {
			$_SESSION['success'] = "about has been permanently deleted successfully";
			header("location: about-list.php");
		}else{
			$_SESSION['error'] = "Something went to wrong";
			header("location: about-list.php");
		}

}else{
	header("location: about-list.php");
}

?>
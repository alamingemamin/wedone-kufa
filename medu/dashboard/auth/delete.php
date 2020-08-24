<?php
 session_start();
 include "../auth_check.php"; 
 ?>
   <?php  include "../../includes/database.php";
if (isset($_GET['id']) && $_GET['file_name']) {
	$id = $_GET['id'];
	$file_name = $_GET['file_name'];

	$unlink = "../../uploads/users-photos/".$file_name;
	if (unlink($unlink)) {
		$delete_sql   = "DELETE FROM users WHERE id='$id' && user_photo='$file_name'";
		$delete_query =  mysqli_query($connect,$delete_sql);

		if ($delete_query) {
			$_SESSION['success'] = "User has been Deleted Successfully";
			header("location: all_users.php");

		}else{
			$_SESSION['error'] = "Ooops !! User does not delete.please try again";
			header("location: all_users.php");
			
		}
	}else{
		$_SESSION['error'] = "Ooops !! file does not deleted";

	}
	
}else {
    header("location: all_users.php");
}
?>
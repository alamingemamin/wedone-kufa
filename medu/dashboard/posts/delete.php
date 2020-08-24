<?php
 session_start();
 include "../auth_check.php"; 
 ?>
   <?php  include "../../includes/database.php";
if (isset($_GET['id']) && $_GET['file_name']) {
	$id = $_GET['id'];
	$file_name = $_GET['file_name'];

	$unlink = "../../uploads/post-photos/".$file_name;
	if (unlink($unlink)) {
		$delete_sql   = "DELETE FROM posts WHERE id='$id' && photo='$file_name'";
		$delete_query =  mysqli_query($connect,$delete_sql);

		if ($delete_query) {
			$_SESSION['success'] = "post has been Deleted Successfully";
			header("location: post-list.php");

		}else{
			$_SESSION['error'] = "Ooops !! post does not delete.please try again";
			header("location: post-list.php");
			
		}
	}else{
		$_SESSION['error'] = "Ooops !! file does not deleted";

	}
	
}else {
    header("location: post-list.php");
}
?>
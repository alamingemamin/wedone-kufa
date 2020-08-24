<?php
 session_start();
 include "../auth_check.php"; 
 ?>
  <?php  include "../../includes/database.php";
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$restore_sql   = "UPDATE users SET deleted='0' WHERE id='$id'";
	$restore_query =  mysqli_query($connect,$restore_sql);
	if ($restore_query) {
		$_SESSION['success'] = "User restore has been Successfully";
		header("location: all_users.php");

	}else{
		$_SESSION['error'] = "Ooops !! User does restore.please try again";
		header("location: all_users.php");
	}
}else {
    header("location: all_users.php");
 }
?>
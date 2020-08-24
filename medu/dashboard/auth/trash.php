<?php
 session_start();
 include "../auth_check.php"; 
 ?>
  <?php  include "../../includes/database.php";
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$trash_sql   = "UPDATE users SET deleted='1' WHERE id='$id'";
	$trash_query =  mysqli_query($connect,$trash_sql);
	if ($trash_query) {

		$store = "User moved trash has been Successfully <a href='restore.php?id=$id' class='btn btn-info'>Undo</a>";
		
		
		$_SESSION['success'] = $store;
		header("location: all_users.php");

	}else{
		$_SESSION['error'] = "Ooops !! User does not trush.please try again";
		header("location: all_users.php");
	}
}else {
    header("location: all_users.php");
 }
?>
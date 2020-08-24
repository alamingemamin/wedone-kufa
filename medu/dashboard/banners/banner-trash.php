<?php
 session_start();
 include "../auth_check.php"; 
 ?>
  <?php  include "../../includes/database.php";
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$trash_sql   = "UPDATE banners SET deleted='1' WHERE id='$id'";
	$trash_query =  mysqli_query($connect,$trash_sql);
	if ($trash_query) {

		$store = "banner moved trash has been Successfully <a href='banner-restore.php?id=$id' class='btn btn-info'>Undo</a>";
		
		
		$_SESSION['success'] = $store;
		header("location: banner-list.php");

	}else{
		$_SESSION['error'] = "Ooops !! banner does not trush.please try again";
		header("location: banner-list.php");
	}
}else {
    header("location: banner-list.php");
 }
?>
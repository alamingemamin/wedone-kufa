<?php
 session_start();
 include "../auth_check.php"; 
 ?>
  <?php  include "../../includes/database.php";
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$trash_sql   = "UPDATE projects SET deleted='1' WHERE id='$id'";
	$trash_query =  mysqli_query($connect,$trash_sql);
	if ($trash_query) {

		$store = "project moved trash has been Successfully <a href='project-restore.php?id=$id' class='btn btn-info'>Undo</a>";
		
		
		$_SESSION['success'] = $store;
		header("location: project-list.php");

	}else{
		$_SESSION['error'] = "Ooops !! project does not trush.please try again";
		header("location: project-list.php");
	}
}else {
    header("location: project-list.php");
 }
?>
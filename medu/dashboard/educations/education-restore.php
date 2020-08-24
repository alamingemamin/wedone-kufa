<?php
 session_start();
 include "../auth_check.php"; 
 ?>
  <?php  include "../../includes/database.php";
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$trash_sql   = "UPDATE educations SET deleted='0' WHERE id='$id'";
	$trash_query =  mysqli_query($connect,$trash_sql);
	if ($trash_query) {

		$store = "education restore has been Successfully ";
		
		
		$_SESSION['success'] = $store;
		header("location: education-list.php");

	}else{
		$_SESSION['error'] = "Ooops !! education does not restore.please try again";
		header("location: education-list.php");
	}
}else {
    header("location: education-list.php");
 }
?>
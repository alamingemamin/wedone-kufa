<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";

  if (isset($_GET['id'])) {
  	$id = $_GET['id'];
  	$delete_sql   = "DELETE FROM banner_icons WHERE id='$id'";
  	$delete_query = mysqli_query($connect,$delete_sql);
  	if ($delete_query) {
  		$_SESSION['success'] = "banner icon deleted has been successfully complated";
        header("location: banner-icons-list.php");
  	}else{
  		$_SESSION['error'] = "Opss!! banner icon deos not deleted";
        header("location: banner-icons-list.php");
        
  	}
  }

?>
<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";

  if (isset($_GET['id'])) {
  	$id = $_GET['id'];
  	$update_trash = "UPDATE banner_icons SET deleted='1' WHERE id='$id'";
  	$update_query = mysqli_query($connect,$update_trash);

    if ($update_query) {
  		$_SESSION['success'] = "banner icon move to trash has been successfully complated. <a href='banner-icons-restore.php?id=$id' class='btn btn-info btn-sm'>Undo</a>";
        header("location: banner-icons-list.php");
  	}else{
  		$_SESSION['error'] = "Opss!! banner icon deos not move to trash";
        header("location: banner-icons-list.php");
        
  	}

  }else{

  }


 ?>
<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";
 
  if (isset($_GET['id'])) {
  	$id = $_GET['id'];
  	$update_trash = "UPDATE guests SET deleted='0' WHERE id='$id'";
  	$update_query  = mysqli_query($connect,$update_trash);
    if ($update_query) {
         $_SESSION['success'] = "Guest message restore has been successfully";
         header("location: guest-list.php");

    }else{
        $_SESSION['error'] = "Opss!!, Guest message does not restore";
         header("location: guest-list.php");
    }


}
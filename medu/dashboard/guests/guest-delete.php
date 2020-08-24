<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";
 
  if (isset($_GET['id'])) {
  	$id = $_GET['id'];
  	$delete = "DELETE FROM guests WHERE id='$id'";
  	$delete_query  = mysqli_query($connect,$delete);
    if ($delete_query) {
         $_SESSION['success'] = "Guest message has been permanently deleted successfully";
         header("location: guest-list.php");

    }else{
        $_SESSION['error'] = "Opss!!, Guest message does not deleted";
         header("location: guest-list.php");
    }


}
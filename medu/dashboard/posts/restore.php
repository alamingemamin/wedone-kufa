<?php
 session_start();
 include "../auth_check.php"; 
 ?>
  <?php  include "../../includes/database.php";
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $trash_sql   = "UPDATE posts SET deleted='0' WHERE id='$id'";
  $trash_query =  mysqli_query($connect,$trash_sql);
  if ($trash_query) {

    $store = "post restore  has been Successfully";
    
    
    $_SESSION['success'] = $store;
    header("location: post-list.php");

  }else{
    $_SESSION['error'] = "Ooops !! posts does not trush.please try again";
    header("location: post-list.php");
  }
}else {
    header("location: post-list.php");
 }
?>
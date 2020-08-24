<?php
session_start();
include "../auth_check.php";
include "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];
    

    $select_sql   = "SELECT * FROM banners WHERE id='$id'";
    $select_query = mysqli_query($connect,$select_sql);
    $select_row   = mysqli_fetch_assoc($select_query);

    if (unlink('../../uploads/banners-photos/'.$select_row['banner_photo'])) {
    	$delete_sql   = "DELETE FROM banners WHERE id='$id'";
		$delete_query = mysqli_query($connect,$delete_sql);
		
		if ($delete_query) {
			$_SESSION['success'] = "Your banner has been deleted successfully";
			header("location: banner-list.php");
		}else{
			$_SESSION['error'] = "Your banner has not deleted";
			header("location: banner-list.php");
		}
    }else{
			$_SESSION['error'] = "Banner file does not deleted";
			header("location: banner-list.php");

    }

	
	
}else{
  header("location: banner-list.php");
}




?>
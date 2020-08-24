<?php
session_start();
include "../auth_check.php";
include "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];
    

    $select_sql   = "SELECT * FROM clients WHERE id='$id'";
    $select_query = mysqli_query($connect,$select_sql);
    $select_row   = mysqli_fetch_assoc($select_query);

    if (unlink('../../uploads/clients-photos/'.$select_row['client_photo'])) {
    	$delete_sql   = "DELETE FROM clients WHERE id='$id'";
		$delete_query = mysqli_query($connect,$delete_sql);
		
		if ($delete_query) {
			$_SESSION['success'] = "Your client has been deleted successfully";
			header("location: client-list.php");
		}else{
			$_SESSION['error'] = "Your client has not deleted";
			header("location: client-list.php");
		}
    }else{
			$_SESSION['error'] = "client file does not deleted";
			header("location: client-list.php");

    }

	
	
}else{
  header("location: client-list.php");
}




?>
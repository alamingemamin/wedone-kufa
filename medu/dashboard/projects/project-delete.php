<?php
session_start();
include "../auth_check.php";
include "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];
    

    $select_sql   = "SELECT * FROM projects WHERE id='$id'";
    $select_query = mysqli_query($connect,$select_sql);
    $select_row   = mysqli_fetch_assoc($select_query);

    if (unlink('../../uploads/projects-photos/'.$select_row['project_photo'])) {
    	$delete_sql   = "DELETE FROM projects WHERE id='$id'";
		$delete_query = mysqli_query($connect,$delete_sql);
		
		if ($delete_query) {
			$_SESSION['success'] = "Your project has been deleted successfully";
			header("location: project-list.php");
		}else{
			$_SESSION['error'] = "Your project has not deleted";
			header("location: project-list.php");
		}
    }else{
			$_SESSION['error'] = "project file does not deleted";
			header("location: project-list.php");

    }

	
	
}else{
  header("location: project-list.php");
}




?>
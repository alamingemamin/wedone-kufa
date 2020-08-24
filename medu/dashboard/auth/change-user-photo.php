<?php 
session_start();

include '../auth_check.php';
include '../../includes/database.php';

if (isset($_GET['filename'])) {
	$filename = $_GET['filename'];
	echo $filename;
}


?>
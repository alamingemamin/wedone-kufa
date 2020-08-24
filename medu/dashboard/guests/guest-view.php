<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";
 
  if (isset($_GET['id'])) {
  	$id = $_GET['id'];
  	$update_status = "UPDATE guests SET status='1' WHERE id='$id'";
  	$update_query  = mysqli_query($connect,$update_status);
    if (!$update_query) {
         header("location: guest-list.php");
    }
    
    $view_sql   = "SELECT * FROM guests WHERE id='$id'";
    $view_query = mysqli_query($connect,$view_sql);
    $view_row   = mysqli_fetch_assoc($view_query);

    
  }else{
  	header("location: guest-list.php");
  }

$title = "All Guests list page";
?>
<?php require "../../includes/layouts/header.php"; ?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			
					<div class="card-header clearfix" style="background: #112236;">
						  <h5 class="float-left"><td><?= $view_row['guest_name']; ?></td></h5>
						 <a href="guest-list.php" class="btn btn-sm btn-pink float-right">Back to guest list</a>
					</div>
					<table class="table table-sm">
						<tr>
							<th>Guest Name</th>
							<td><?= $view_row['guest_name']; ?></td>
						</tr>
						<tr>
							<th>Guest Email</th>
							<td><?= $view_row['guest_email']; ?></td>
						</tr>
						<tr>
							<th>Guest Message</th>
							<td><?= $view_row['guest_message']; ?></td>
						</tr>
						<tr>
							<th>Sent Date</th>
							<td><?= $view_row['created_at']; ?></td>
						</tr>
					</table>
				
			</div>
		</div>
	</div>
</div>

<?php require "../../includes/layouts/footer.php"; ?>
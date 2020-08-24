<?php
session_start();
include "../auth_check.php";
include "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$view_sql   = "SELECT * FROM facts WHERE id='$id'";
	$view_query = mysqli_query($connect,$view_sql);
	$view_row   = mysqli_fetch_assoc($view_query);
	
	
}else{
  header("location: fact-list.php");
}


$title = "fact view page";

?>

<?php require "../../includes/layouts/header.php"; ?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card-box">
					<div class="p-2 text-center font-weight-bold"><?= ucwords($view_row['fact_title']); ?></div>
					<div class="card-body">
						<table class="table table-bordered table-sm">
							<tr>
								<th>ID</th>
								<td><?= $view_row['id']; ?></td>
							</tr>
							<tr>
								<th>fact Icon</th>
								<td title="<?= $view_row['fact_icon']; ?>"><i class="<?= $view_row['fact_icon']; ?>" style="<?= $view_row['fact_icon_color']; ?>"></i></td>
							</tr>
							<tr>
								<th>fact Title</th>
								<td><?= $view_row['fact_title']; ?></td>
							</tr>
							<tr>
								<th>fact Description</th>
								<td><?= $view_row['fact_count']; ?></td>
							</tr>
							<tr>
								<th>Created Date</th>
								<td><?= $view_row['created_at']; ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require "../../includes/layouts/footer.php"; ?>
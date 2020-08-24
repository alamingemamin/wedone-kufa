<?php
session_start();
include "../auth_check.php";
include "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$view_sql   = "SELECT * FROM projects WHERE id='$id'";
	$view_query = mysqli_query($connect,$view_sql);
	$view_row   = mysqli_fetch_assoc($view_query);
	
	
}else{
  header("location: project-list.php");
}


if (isset($_POST['change-project-btn'])) {
	$project_new_photo = $_FILES['project_photo'];
	$project_explode   = explode('.',$project_new_photo['name']);
	$extension        = strtolower(end($project_explode));
	$allowed          = array('jpg','png','jpeg','gif');

	if ($project_new_photo['name'] == null) {
		$_SESSION['error']  = "project file does not found!!";

	}elseif (!in_array($extension,$allowed)) {
		$_SESSION['error']  = "project file format does not support!!!";

	}elseif ($project_new_photo['size'] > (1024*1024)) {
		$_SESSION['error']  = "project file is too large!!!";

	}else{
		if (unlink('../../uploads/projects-photos/'.$view_row['project_photo'])) {
			$new_file_name = $view_row['id'].'.'.$extension;
			$destination   = '../../uploads/projects-photos/'.$new_file_name;
			if (move_uploaded_file($project_new_photo['tmp_name'],$destination)) {
				$update_project = "UPDATE projects SET project_photo='$new_file_name' WHERE id='$id'";
				$update_query  = mysqli_query($connect,$update_project);

				if ($update_query) {
					$_SESSION['success']  = "Good. project photo change has been successfully";
					header("location: project-view.php");

				}else{
					$_SESSION['error'] = "Opps!!!, project photo deos not change.please try again";

				}
			}else{
				$_SESSION['error'] = "your new FIle does not uploaded!!!";

			}
		}else{
			$_SESSION['error']  = "Your old project file does not deleted!!!";
		}
	}
}

$title = "project view page";

?>

<?php require "../../includes/layouts/header.php"; ?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card-box">
					<div class="p-2 text-center font-weight-bold"><?= ucwords($view_row['project_name']); ?></div>
					<div class="card-body">


						<?php if(isset($_SESSION['success'])): ?>
                                            <script type="text/javascript">
                                              Swal.fire({
                                                icon: 'success',
                                                html:'<p><b class="text-success"><i class="fa fa-success"></i></b>&nbsp&nbsp&nbsp<span class="text-success"><?php echo $_SESSION['success']; ?></span></p>'
                                              });
                                            </script>

                        <?php endif; unset($_SESSION['success']);  ?>

                        
                        <?php if(isset($_SESSION['error'])): ?>
                                            <script type="text/javascript">
                                              Swal.fire({
                                                icon: 'error',
                                                html:'<p><b class="text-danger"><i class="fa fa-warning"></i></b>&nbsp&nbsp&nbsp<span class="text-warning"><?php echo $_SESSION['error']; ?></span></p>'
                                              });
                                            </script>

                        <?php endif; unset($_SESSION['error']);  ?>


						<table class="table table-bordered table-sm">
							<tr>
								<th>ID</th>
								<td><?= $view_row['id']; ?></td>
							</tr>
							<tr>
								<th>project Photo</th>
								<td>
									<div class="card">
										<img src="../../uploads/projects-photos/<?= $view_row['project_photo'];?>" class="card-img img-fluid" style="width: 100vh;height: 100vh;">
										<div class="card-img-overlay">
											<button class="btn btn-success" id="change-project-click">Change project Photos</button>
											<div id="change-project-photo" class="mt-2" style="display: none;">
												<form action="" method="post" enctype="multipart/form-data">
													<div class="form-group w-25">
														<div class="input-group">
															<div class="input-group-append">
																<span class="input-group-text"><i class="fa fa-photo"></i></span>
															</div>
															<input type="file" name="project_photo" class="form-control form-control-file">
														</div>
													</div>
													<div class="form-group">
														<input type="submit" name="change-project-btn" class="btn btn-pink w-25">
													</div>
											    </form>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<th>project Title</th>
								<td><?= $view_row['project_title']; ?></td>
							</tr>

							<tr>
								<th>project sub title </th>
								<td><?= $view_row['project_sub_title']; ?></td>
							</tr>

							<tr>
								<th>project description</th>
								<td><?= $view_row['project_description']; ?></td>
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
<?php 
session_start();
require_once "../auth_check.php";
require_once "../../includes/database.php";

$select_site_identy = "SELECT * FROM site_identy LIMIT 1";
$site_identy_query  = mysqli_query($connect,$select_site_identy);
$site_identy_row    = mysqli_fetch_assoc($site_identy_query);


if (isset($_POST['add'])) {
	$update_id = $_POST['id'];
	$site_title  = mysqli_real_escape_string($connect,trim($_POST['site-title']));
	$site_footer = mysqli_real_escape_string($connect,trim($_POST['site-footer']));
	$site_icon   = $_FILES['site-icon'];


	if (empty($site_title)) {
	    $_SESSION['error'] = "Site title must be required";

	}elseif (empty($site_footer)) {
		$_SESSION['error'] = "Site footer must be required";

	}else{
		if ($site_icon['name'] != null) {
			$explode   = explode('.',$site_icon['name']);
			$extension = strtolower(end($explode));
			$allowed   = array('png','ico');
			if (!in_array($extension, $allowed)) {
				$_SESSION['error'] = "Site Icon photo must be use png or ico type";
			}elseif ($site_icon['size'] > (1024*1024)) {
				$_SESSION['error'] = "Site icon size too large!!.use maximum 1mb not more then";
			}else{
				$site_icon_name = $update_id.'.'.$extension;
                $destination    = '../../uploads/site-icons/'.$site_icon_name;
                if (file_exists($destination)) {
                	if (unlink($destination)) {
                	   if (move_uploaded_file($site_icon['tmp_name'],$destination)) {
		                	$update_sql = "UPDATE site_identy SET title='$site_title', footer='$site_footer', icon='$site_icon_name' WHERE id='$update_id'";
		                	$update_result = mysqli_query($connect,$update_sql);

		                	if ($update_result) {
		                		$_SESSION['success'] = "Site identification updated successfully";
		                	
		                	}else{
		                		$_SESSION['error'] = "Site identification updated successfully";	
		                	}
		                }else{
		                	$_SESSION['error'] = "site icon does not upload.try to again!!";
		                }

                	}else{
                        $_SESSION['error'] = "existing icon does not delelted";
                	}
                }else{
	                if (move_uploaded_file($site_icon['tmp_name'],$destination)) {
	                	$update_sql = "UPDATE site_identy SET title='$site_title', footer='$site_footer', icon='$site_icon_name' WHERE id='$update_id'";
	                	$update_result = mysqli_query($connect,$update_sql);

	                	if ($update_result) {
	                		$_SESSION['success'] = "Site identification updated successfully";
	                	
	                	}else{
	                		$_SESSION['error'] = "Site identification updated successfully";	
	                	}
	                }else{
	                	$_SESSION['error'] = "site icon does not upload.try to again!!";
	                }

                }
			}
		}else{
			$update_site    = "UPDATE site_identy SET title='$site_title', footer='$site_footer'WHERE id='$update_id'";
			$update_site_query =  mysqli_query($connect,$update_site);

			if ($update_site_query) {
				$_SESSION['success'] = "Site identy update has been successfully";
				header("location: site-identify-list.php");
			}else{
				$_SESSION['error'] = "Something went to wrong";
			}
		}
	}
}



$title = "Site identy list | medu";
include "../../includes/layouts/header.php";

?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				 <!-- show success message when user successfully verified -->
           <?php  if (isset($_SESSION['success'])): ?>

            <script type="text/javascript">
              Swal.fire({
                icon: 'success',
                html:'<p><b><i class="fa fa-success"></i></b><?php echo $_SESSION['success']; ?></p>',
              })
            </script>

           <?php endif; unset($_SESSION['success']); ?>



        
           <!-- show error message when user not verified or already verified -->
           <?php  if (isset($_SESSION['error'])): ?>

            <script type="text/javascript">
              Swal.fire({
                icon: 'error',
                html:'<p><b><i class="fa fa-warning"></i></b><?php echo $_SESSION['error']; ?></p>',
              })
            </script>

           <?php endif; unset($_SESSION['error']); ?>

				<div class="text-white">
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>footer</th>
								<th>icon</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td><?= $site_identy_row['title']; ?></td>
								<td><?= $site_identy_row['footer']; ?></td>
								<td><img src="../../uploads/site-icons/<?= $site_identy_row['icon']; ?>"></td>
								<td>
									<?php if ($_SESSION['user_role'] == 1) { ?>

									<!-- Button trigger modal -->
									<a class="btn text-custom" data-toggle="modal" data-target="#exampleModaledit<?= $site_identy_row['id'];?>">
									 <i class="fas fa-edit"></i> 
									</a>

									<!-- Modal -->
									<div class="modal fade" id="exampleModaledit<?= $site_identy_row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									  <div class="modal-dialog modal-dialog-centered" role="document">
									    <div class="modal-content">
									      <div class="modal-header" style="background: #112233;">
									        <h5 class="modal-title" id="exampleModalLongTitle">Update Site identification</h5>
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
									      </div>
									      <div class="modal-body text-center" style="background: #112233;">
									      	<img src="../../uploads/site-icons/<?= $site_identy_row['icon']; ?>">
									        <form action="" method="post" enctype="multipart/form-data">
									        	 <input type="hidden" name="id" value="<?= $site_identy_row['id'];?>">
									        	 <div class="form-group">
									        	 	<label class="float-left text-purple">Site title : </label>
									        	 	<div class="input-group">
									        	 		<div class="input-group-append">
									        	 			<span class="input-group-text"><i class="fas fa-heart"></i></span>
									        	 		</div>
									        	 		<input type="text" name="site-title" placeholder="Site title" class="form-control" value="<?= $site_identy_row['title'] ?>">
									        	 	</div>
									        	 </div>


									        	 <div class="form-group">
									        	 	<label class="float-left text-purple">Site Footer copyright : </label>
									        	 	<div class="input-group">
									        	 		<div class="input-group-append">
									        	 			<span class="input-group-text"><i class="fas fa-heart"></i></span>
									        	 		</div>
									        	 		<input type="text" name="site-footer" placeholder="Site footer" class="form-control" value="<?= $site_identy_row['footer'] ?>">
									        	 	</div>
									        	 </div>


									        	 <div class="form-group">
									        	 	<label class="float-left text-purple">Site Icon: </label>
									        	 	<div class="input-group">
									        	 		<div class="input-group-append">
									        	 			<span class="input-group-text"><i class="fas fa-images"></i></span>
									        	 		</div>
									        	 		<input type="file" name="site-icon" class="form-control form-control-file" value="<?= $site_identy_row['icon'] ?>">
									        	 	</div>
									        	 </div>

									        	 <div class="form-group">
									        	 	<input type="submit" name="add" class="btn btn-pink" value="Published">
									        	 </div>
									        </form>
									      </div>
									      <div class="modal-footer" style="background: #112233;">
									        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									      </div>
									    </div>
									  </div>
									</div>

									<a href="delete.php?id<?= $site_identy_row['id'];?>" class="btn text-danger"><i class="fas fa-trash"></i></a>
										
									<?php } ?>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>footer</th>
								<th>icon</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include "../../includes/layouts/footer.php";


 ?>
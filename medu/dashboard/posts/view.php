<?php session_start(); ?>

<?php

include "../auth_check.php"; 

require "../../includes/database.php";

if (isset($_GET['id']) && $_GET['file_name']) {
	$id = $_GET['id'];
  $file_name = $_GET['file_name'];
	$view_sql   = "SELECT * FROM posts WHERE id='$id'";
	$view_query = mysqli_query($connect,$view_sql);
	if ($view_query) {
		$view_row = mysqli_fetch_assoc($view_query);

	}else{
    $_SESSION['error'] = "Query problem.data not found";
		header("location: post-list.php");

	}
}else{
	header("location: post-list.php");
  
}

if (isset($_POST['change-photo-btn'])) {
  if ($_FILES['post_photo']['name'] != null) {
     $explode   = explode('.',$_FILES['post_photo']['name']);
     $extension = strtolower(end($explode));
     $allowed   = array('jpg','png','jpeg','gif');
     if (in_array($extension,$allowed)) {
       if (unlink('../../uploads/post-photos/'.$file_name)) {
         $new_file = $id.'.'.$extension;
         $folder   = '../../uploads/post-photos/'.$new_file;
         if (move_uploaded_file($_FILES['post_photo']['tmp_name'],$folder)) {
           $update_sql = "UPDATE posts SET photo='$new_file' WHERE id='$id'";
           $update_query = mysqli_query($connect,$update_sql);
           if ($update_query) {
                 $_SESSION['success'] = "post photo updated successfully";
                 header("location: post-list.php");
             
           }else{
                $_SESSION['error'] = "OOps!! something went wrong.please try again";

           }
         }

       }else{
          $_SESSION['error'] = "old file does not deleted!!";

       }
       
       
      
     }else{
      $_SESSION['error'] = "File format does not support";

     }
  }else{
    $_SESSION['error'] = "file not found!!";
  }
}

$title = "post view page";
?>


<?php include "../../includes/layouts/header.php"; ?>

        <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                               
                                      <?php  if (isset($_SESSION['error'])): ?>


                                        <script type="text/javascript">
                                          Swal.fire({
                                            icon: 'error',
                                            html:'<p><b class="text-danger"><i class="fa fa-warning"></i></b>&nbsp&nbsp&nbsp<span class="text-warning"><?php echo $_SESSION['error']; ?></span></p>',
                                          })
                                        </script>

                                       <?php endif; unset($_SESSION['error']); ?>

                               <table class="table table-sm table-bordered">

                               	<tr>
                               		<th>Title</th>
                               		<td><?= $view_row['title']; ?></td>
                               	</tr>

                               	<tr>
                               		<th>Body</th>
                               		<td><?= $view_row['body']; ?></td>
                               	</tr>

                                <tr>
                                  <th>Post Photo</th>
                                  <td>
                                    <div class="card">
                                      <img src="../../uploads/post-photos/<?= $file_name;?>" class="card-img img-fluid" style="width: 100%;height: 400px;">
                                      <div class="card-img-overlay">
                                        <a href="#" id="user-change-click" class="btn btn-success">Change post Photo</a>

                                        <div id="change-user-photo" style="display: none;">
                                          <form action="" method="post" enctype="multipart/form-data" class="">
                                            <div class="form-group w-25">
                                              <div class="input-group">
                                                <div class="input-group-append">
                                                  <span class="input-group-text"><i class="fa-fa-photo"></i></span>
                                                </div>
                                                <input type="file" name="post_photo" class="form-control form-control-file">
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <input type="submit" name="change-photo-btn" value="Update user photo" class="btn btn-pink">
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>

                              

                               	<tr>
                               		<th>User</th>
                               		<td><?= $view_row['user']; ?></td>
                               	</tr>
                                <tr>
                                  <th>Created Date</th>
                                  <td><?= $view_row['created_at'];?></td>
                                </tr>
                               </table>
                            </div>
                        </div> 
                    </div> <!-- container -->
                </div> <!-- content -->


<?php include "../../includes/layouts/footer.php"; ?>
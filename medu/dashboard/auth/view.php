<?php session_start(); ?>

<?php

include "../auth_check.php"; 

require "../../includes/database.php";

if (isset($_GET['id']) && $_GET['file_name']) {
	$id = $_GET['id'];
  $file_name = $_GET['file_name'];
	$view_sql   = "SELECT * FROM users WHERE id='$id'";
	$view_query = mysqli_query($connect,$view_sql);
	if ($view_query) {
		$view_row = mysqli_fetch_assoc($view_query);

	}else{
    $_SESSION['error'] = "Query problem.data not found";
		header("location: all_users.php");

	}
}else{
	header("location: all_users.php");
  
}

if (isset($_POST['change-photo-btn'])) {
  if ($_FILES['user_photo']['name'] != null) {
     $explode   = explode('.',$_FILES['user_photo']['name']);
     $extension = strtolower(end($explode));
     $allowed   = array('jpg','png','jpeg','gif');
     if (in_array($extension,$allowed)) {
       if (unlink('../../uploads/users-photos/'.$file_name)) {
         $new_file = $id.'.'.$extension;
         $folder   = '../../uploads/users-photos/'.$new_file;
         if (move_uploaded_file($_FILES['user_photo']['tmp_name'],$folder)) {
           $update_sql = "UPDATE users SET user_photo='$new_file' WHERE id='$id'";
           $update_query = mysqli_query($connect,$update_sql);
           if ($update_query) {
                 $_SESSION['success'] = "user photo updated successfully";
                 header("location: all_users.php");
             
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

$title = "User view page";
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
                               		<th>ID</th>
                               		<td><?= $view_row['id']; ?></td> 		
                               	</tr>

                               	<tr>
                               		<th>Name</th>
                               		<td><?= $view_row['name']; ?></td>
                               	</tr>

                               	<tr>
                               		<th>Gender</th>
                               		<td><?= $view_row['gender']; ?></td>
                               	</tr>

                                <tr>
                                  <th>User Photo</th>
                                  <td>
                                    <div class="card">
                                      <img src="../../uploads/users-photos/<?= $file_name;?>" class="card-img img-fluid" style="width: 100%;height: 400px;">
                                      <div class="card-img-overlay">
                                        <a href="#" id="user-change-click" class="btn btn-success">Change user Photo</a>

                                        <div id="change-user-photo" style="display: none;">
                                          <form action="" method="post" enctype="multipart/form-data" class="">
                                            <div class="form-group w-25">
                                              <div class="input-group">
                                                <div class="input-group-append">
                                                  <span class="input-group-text"><i class="fa-fa-photo"></i></span>
                                                </div>
                                                <input type="file" name="user_photo" class="form-control form-control-file">
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
                               		<th>Role</th>
                               		<td>
                                    <?php if ($view_row['role'] == 1) {
                                        echo "Admin";
                                      }elseif ($view_row['role'] == 2) {
                                        echo "Moderator";
                                      }elseif ($view_row['role'] == 3) {
                                        echo "Editor";
                                      }else{
                                        echo "Normal"; 
                                      } 
                                    ?> 
                                  </td>
                               	</tr>

                               	<tr>
                               		<th>Email</th>
                               		<td><?= $view_row['email']; ?></td>
                               	</tr>

                               	<tr>
                               		<th>Password</th>
                               		<td><?= $view_row['password']; ?></td>
                               	</tr>
                               </table>
                            </div>
                        </div> 
                    </div> <!-- container -->
                </div> <!-- content -->


<?php include "../../includes/layouts/footer.php"; ?>
<?php 

session_start();
include "../auth_check.php";
include "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$edit_sql   = "SELECT * FROM projects WHERE id='$id'";
	$edit_query = mysqli_query($connect,$edit_sql);
	$edit_row   = mysqli_fetch_assoc($edit_query);
	
	
}else{
  header("location: project-list.php");
}


if (isset($_POST['update-project'])) {
                $project_name           = mysqli_real_escape_string($connect,trim($_POST['project_name']));
                $project_description    = mysqli_escape_string($connect,htmlentities(trim($_POST['project_description'])));
                $project_id             = $_POST['project_id'];
                $project_title          = mysqli_real_escape_string($connect,trim($_POST['project_title'])); 
                $project_sub_title      = mysqli_real_escape_string($connect,trim($_POST['project_sub_title']));     
                
                
                if (empty($project_name)) {
                  $_SESSION['error'] = "project name is required";

                }elseif (empty($project_title)) {
                  $_SESSION['error'] = "project title is required";

                }elseif (empty($project_description)) {
                  $_SESSION['error'] = "project description is required";

                }elseif (empty($project_sub_title)) {
                  $_SESSION['error'] = "project sub title is required";

                }elseif (is_numeric($project_name)) {
                  $_SESSION['error'] = "project name must be use alphabatic character";

                }else{
                  $select_sql   = "SELECT * FROM projects WHERE project_title='$project_title' AND project_name='$project_name'";
                  $select_query = mysqli_query($connect,$select_sql);
                  $count_row    = mysqli_num_rows($select_query);
                  if ($count_row >= 1) {
                    $select_sql1   = "SELECT * FROM projects WHERE project_title='$project_title' AND project_name='$project_name' AND id='$project_id'";
                    $select_query1 = mysqli_query($connect,$select_sql1);
                    $count_row1    = mysqli_num_rows($select_query1);

                    if ($count_row1 >= 1) {
                       $update_sql = "UPDATE projects SET project_name='$project_name' ,project_description='$project_description',project_title='$project_title',project_sub_title='$project_sub_title',status='0' WHERE id='$project_id'";

                        $update_query = mysqli_query($connect,$update_sql);
                        if ($update_query) {
                           $_SESSION['success'] = "project Updated has been successfully complated";
                           header("location: project-list.php");

                        }else{
                          $_SESSION['error'] = "Ooops !!, project does not Updated.please try again";
                        }
                    }else{
                    $_SESSION['error'] = "project name  and project title is already exists ! please try to anther project title and project name";

                    }

                  }else{
                    $update_sql = "UPDATE projects SET project_name='$project_name' ,project_description='$project_description',project_title='$project_title',project_sub_title='$project_sub_title',status='0' WHERE id='$project_id'";

                    $update_query = mysqli_query($connect,$update_sql);
                    if ($update_query) {
                       $_SESSION['success'] = "project Updated has been successfully complated";
                       header("location: project-list.php");

                    }else{
                      $_SESSION['error'] = "Ooops !!, project does not Updated.please try again";
                    }
                  }
                }
                
            }

$title = "project edit page";


?>


 <?php require "../../includes/layouts/header.php"; ?>
     

           <?php  if (isset($_SESSION['error'])): ?>


            <script type="text/javascript">
              Swal.fire({
                icon: 'error',
                html:'<p><b class="text-danger"><i class="fa fa-warning"></i></b>&nbsp&nbsp&nbsp<span class="text-warning"><?php echo $_SESSION['error']; ?></span></p>',
              })
            </script>

           <?php endif; unset($_SESSION['error']); ?>

           <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                
                                  
                                  <div class="">
                                      <div class="card-header bg-success text-white clearfix"><b class="float-left">Update project</b><a href="project-list.php" class="btn btn-warning float-right">Back to project list</a></div>
                                            <div class="card-box">
                                             <form action="" method="post">
                                                <input type="hidden" name="project_id" value="<?= $edit_row['id'];?>">
                                                

                                                <div class="row">
                                                   <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label for="title" class="text-white">project title</label>
                                                        <div class="input-group">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fas fa-heart"></i></span>
                                                          </div>
                                                          <input type="text" name="project_title" class="form-control" id="project_title"  placeholder="project title" value="<?= $edit_row['project_title']; ?>">
                                                        </div> 
                                                      </div>
                                                    </div>

                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                      <label for="title" class="text-white">project name</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-project"></i></span>
                                                        </div>
                                                        <input type="text" name="project_name" class="form-control" id="project_name" value="<?= $edit_row['project_name']; ?>">
                                                      </div> 
                                                    </div>
                                                  </div>

                                                  <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label for="title" class="text-white">project sub title</label>
                                                        <div class="input-group">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fas fa-heart"></i></span>
                                                          </div>
                                                          <input type="text" name="project_sub_title" class="form-control" id="project_sub_title"  placeholder="project sub" value="<?= $edit_row['project_sub_title']; ?>">
                                                        </div> 
                                                      </div>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                  <label class="text-white">project description</label>
                                                  <div class="input-group">
                                                    <div class="input-group-append">
                                                      <span class="input-group-text"><i class="fa fa-male"></i></span>
                                                    </div>
                                                    <textarea name="project_description" class="form-control" cols="5" rows="5"><?= $edit_row['project_description']; ?></textarea>
                                                  </div>
                                                </div>
               
                                
                                                <div class="form-group">
                                                  <button type="submit" name="update-project" class="btn btn-pink w-50">Update project </button>
                                                </div>
                                              </form>
                                         </div>
                                      
                                       </div>
                                     </div>
                                   </div>

                               
                            </div>
                        </div> 
                    </div> <!-- container -->
                </div> <!-- content -->

           
    

    <?php require "../../includes/layouts/footer.php"; ?>
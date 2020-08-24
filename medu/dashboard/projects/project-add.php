        <?php  session_start();  ?>

              <?php include "../auth_check.php"; ?>
              
              <?php

              require "../../includes/database.php";  
              if (isset($_POST['add-project'])) {
                $project_name           = mysqli_real_escape_string($connect,trim($_POST['project_name']));
                $project_title          = mysqli_real_escape_string($connect,trim($_POST['project_title']));
                $project_description    = mysqli_escape_string($connect,htmlspecialchars(trim($_POST['project_description'])));
                $project_sub_title      = mysqli_real_escape_string($connect,trim($_POST['project_sub_title']));
                $project_photo          = $_FILES['project_photo'];
                $photo_explode          = explode('.',$project_photo['name']);
                $extension              = strtolower(end($photo_explode));
                $allowed                = array('jpg','jpeg','png','gif');

                
                
                if (empty($project_name)) {
                  $_SESSION['error'] = "project name is required";

                }elseif (empty($project_title)) {
                  $_SESSION['error'] = "project title is required";

                }elseif (empty($project_sub_title)) {
                  $_SESSION['error'] = "project sub title is required";

                }elseif ($project_photo['name'] == null) {
                  $_SESSION['error'] = "project photo deos not found!!";
                  
                }elseif (!in_array($extension,$allowed)) {
                  $_SESSION['error'] = "project photo file type does not support!!";
                  
                }elseif ($project_photo['size'] > (1024*1024)) {
                  $_SESSION['error'] = "project Photo is too large!!";
                  
                }elseif (empty($project_description)) {
                  $_SESSION['error'] = "project description is required";

                }elseif (is_numeric($project_name)) {
                  $_SESSION['error'] = "project title must be use alphabatic character";

                }else{
                  $select_sql   = "SELECT * FROM projects WHERE project_name='$project_name' AND project_title='$project_title'";
                  $select_query = mysqli_query($connect,$select_sql);
                  $count_row    = mysqli_num_rows($select_query);
                  if ($count_row >= 1) {
                    $_SESSION['error'] = "project name and project title is already exists ! please try to anther project  and project name";

                  }else{
                     $insert_sql = "INSERT INTO projects(project_title,project_name,project_sub_title,project_description,status) VALUES ('$project_title','$project_name','$project_sub_title','$project_description','0')";

                    $insert_query = mysqli_query($connect,$insert_sql);
                    $last_id      = mysqli_insert_id($connect);
                    $file_name    = $last_id.'.'.$extension;
                    $destination  = '../../uploads/projects-photos/'.$file_name;

                    if (move_uploaded_file($project_photo['tmp_name'],$destination)) {
                      $update_project = "UPDATE projects SET project_photo='$file_name' WHERE id='$last_id'";
                      $update_query  = mysqli_query($connect,$update_project);

                      if ($update_query) {
                         $_SESSION['success'] = "project insert has been successfully complated";
                         header("location: project-list.php");

                       }else{
                         $_SESSION['error'] = "Ooops !!, project does not insert.please try again";
                       }
                    }else{
                         $_SESSION['error'] = "project photo does not uploaded";

                    }
                    
                  }
                }
                
            }

          $title = "project create page";

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
                                      <div class="card-header bg-success text-white clearfix"><b class="float-left">Add New project</b><a href="project-list.php" class="btn btn-warning float-right">Back to project list</a></div>
                                            <div class="card-box">
                                             <form action="" method="post" enctype="multipart/form-data">

                                                <div class="row">    
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="title" class="text-white">project title</label>
                                                          <div class="input-group">
                                                            <div class="input-group-append">
                                                              <span class="input-group-text"><i class=" fas fa-globe"></i></span>
                                                            </div>
                                                            <input type="text" name="project_title" class="form-control" id="project_title"  placeholder="project title" value="<?php if(isset($_POST['project_title'])){echo $_POST['project_title']; } ?>">
                                                          </div> 
                                                      </div>
                                                  </div>
                                          
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label for="title" class="text-white">project Name</label>
                                                        <div class="input-group">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fas fa-heart"></i></span>
                                                          </div>
                                                          <input type="text" name="project_name" class="form-control" id="greeting"  placeholder="project name" value="<?php if(isset($_POST['project_name'])){echo $_POST['project_name']; } ?>">
                                                        </div> 
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="title" class="text-white">project sub title</label>
                                                          <div class="input-group">
                                                            <div class="input-group-append">
                                                              <span class="input-group-text"><i class=" fas fa-globe"></i></span>
                                                            </div>
                                                            <input type="text" name="project_sub_title" class="form-control" id="project_sub_title"  placeholder="project sub title" value="<?php if(isset($_POST['project_sub_title'])){echo $_POST['project_sub_title']; } ?>">
                                                          </div> 
                                                      </div>
                                                  </div>    
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-white">Choose project Photo</label>
                                                        <div class="input-group">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text">
                                                              <i class="fa fa-photo"></i>
                                                            </span>
                                                          </div>
                                                          <input type="file" name="project_photo" class="form-control form-control-file">
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
                                                    <textarea name="project_description" class="form-control" cols="5" rows="5" placeholder="project description"><?php 
                                                   if (isset($_POST['project_description'])) {
                                                      echo $_POST['project_description'];
                                                    } ?></textarea>
                                                  </div>
                                                </div>
               
                                
                                                <div class="form-group">
                                                  <button type="submit" name="add-project" class="btn btn-pink w-50">Add project </button>
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
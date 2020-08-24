        <?php  session_start();  ?>

              <?php include "../auth_check.php"; ?>
              
              <?php

              require "../../includes/database.php";  
              if (isset($_POST['add-banner'])) {
                $greeting               = mysqli_real_escape_string($connect,trim($_POST['greeting']));
                $banner_title           = mysqli_real_escape_string($connect,trim($_POST['banner_title']));
                $banner_description     = mysqli_real_escape_string($connect,trim(htmlspecialchars($_POST['banner_description'])));
                
                $banner_photo           = $_FILES['banner_photo'];
                $photo_explode          = explode('.',$banner_photo['name']);
                $extension              = strtolower(end($photo_explode));
                $allowed                = array('jpg','jpeg','png','gif');

                
                
                if (empty($banner_title)) {
                  $_SESSION['error'] = "banner Title is required";

                }elseif ($banner_photo['name'] == null) {
                  $_SESSION['error'] = "Banner photo deos not found!!";
                  
                }elseif (!in_array($extension,$allowed)) {
                  $_SESSION['error'] = "banner photo file type does not support!!";
                  
                }elseif ($banner_photo['size'] > (1024*1024)) {
                  $_SESSION['error'] = "banner Photo is too large!!";
                  
                }elseif (empty($banner_description)) {
                  $_SESSION['error'] = "banner description is required";

                }elseif (is_numeric($banner_title)) {
                  $_SESSION['error'] = "banner title must be use alphabatic character";

                }else{
                  $select_sql   = "SELECT * FROM banners WHERE banner_title='$banner_title'";
                  $select_query = mysqli_query($connect,$select_sql);
                  $count_row    = mysqli_num_rows($select_query);
                  if ($count_row >= 1) {
                    $_SESSION['error'] = "banner Title is already exists ! please try to anther banner title";

                  }else{
                     $insert_sql = "INSERT INTO banners(banner_greeting,banner_title,banner_description,status) VALUES ('$greeting','$banner_title','$banner_description','0')";

                    $insert_query = mysqli_query($connect,$insert_sql);
                    $last_id      = mysqli_insert_id($connect);
                    $file_name    = $last_id.'.'.$extension;
                    $destination  = '../../uploads/banners-photos/'.$file_name;

                    if (move_uploaded_file($banner_photo['tmp_name'],$destination)) {
                      $update_banner = "UPDATE banners SET banner_photo='$file_name' WHERE id='$last_id'";
                      $update_query  = mysqli_query($connect,$update_banner);

                      if ($update_query) {
                         $_SESSION['success'] = "banner insert has been successfully complated";
                         header("location: banner-list.php");

                       }else{
                         $_SESSION['error'] = "Ooops !!, banner does not insert.please try again";
                       }
                    }else{
                         $_SESSION['error'] = "Banner photo does not uploaded";

                    }
                    
                  }
                }
                
            }

          $title = "banner create page";

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
                                      <div class="card-header bg-success text-white clearfix"><b class="float-left">Add New banner</b><a href="banner-list.php" class="btn btn-warning float-right">Back to banner list</a></div>
                                            <div class="card-box">
                                             <form action="" method="post" enctype="multipart/form-data">

                                                <div class="row">
                                                  <div class="col-md-4">
                                                      <div class="form-group">
                                                          <label for="title" class="text-white">banner Title</label>
                                                          <div class="input-group">
                                                            <div class="input-group-append">
                                                              <span class="input-group-text"><i class=" fas fa-globe"></i></span>
                                                            </div>
                                                            <input type="text" name="banner_title" class="form-control" id="banner_title"  placeholder="banner title" value="<?php if(isset($_POST['banner_title'])){echo $_POST['banner_title']; } ?>">
                                                          </div> 
                                                      </div>
                                                  </div>
                                          
                                                    <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label for="title" class="text-white">Greetings</label>
                                                        <div class="input-group">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fas fa-heart"></i></span>
                                                          </div>
                                                          <input type="text" name="greeting" class="form-control" id="greeting"  placeholder="example Hello" value="<?php if(isset($_POST['greeting'])){echo $_POST['greeting']; } ?>">
                                                        </div> 
                                                      </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label class="text-white">Choose Banner Photo</label>
                                                        <div class="input-group">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text">
                                                              <i class="fa fa-photo"></i>
                                                            </span>
                                                          </div>
                                                          <input type="file" name="banner_photo" class="form-control form-control-file">
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                  <label class="text-white">banner Description</label>
                                                  <div class="input-group">
                                                    <div class="input-group-append">
                                                      <span class="input-group-text"><i class="fa fa-male"></i></span>
                                                    </div>
                                                    <textarea name="banner_description" class="form-control" cols="5" rows="5" placeholder="banner description"><?php 
                                                   if (isset($_POST['banner_description'])) {
                                                      echo $_POST['banner_description'];
                                                    } ?></textarea>
                                                  </div>
                                                </div>
               
                                
                                                <div class="form-group">
                                                  <button type="submit" name="add-banner" class="btn btn-pink w-50">Add banner </button>
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
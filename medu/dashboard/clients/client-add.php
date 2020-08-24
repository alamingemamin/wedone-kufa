        <?php  session_start();  ?>

              <?php include "../auth_check.php"; ?>
              
              <?php

              require "../../includes/database.php";  
              if (isset($_POST['add-client'])) {
                $client_name            = mysqli_real_escape_string($connect,trim($_POST['client_name']));
                $client_occupation      = mysqli_real_escape_string($connect,trim($_POST['client_occupation']));
                $client_comments        = mysqli_real_escape_string($connect,trim(htmlspecialchars($_POST['client_comments'])));
                $client_photo           = $_FILES['client_photo'];
                $photo_explode          = explode('.',$client_photo['name']);
                $extension              = strtolower(end($photo_explode));
                $allowed                = array('jpg','jpeg','png','gif');

                
                
                if (empty($client_name)) {
                  $_SESSION['error'] = "client name is required";

                }elseif (empty($client_occupation)) {
                  $_SESSION['error'] = "client occupation is required";

                }elseif ($client_photo['name'] == null) {
                  $_SESSION['error'] = "client photo deos not found!!";
                  
                }elseif (!in_array($extension,$allowed)) {
                  $_SESSION['error'] = "client photo file type does not support!!";
                  
                }elseif ($client_photo['size'] > (1024*1024)) {
                  $_SESSION['error'] = "client Photo is too large!!";
                  
                }elseif (empty($client_comments)) {
                  $_SESSION['error'] = "client comments is required";

                }elseif (is_numeric($client_name)) {
                  $_SESSION['error'] = "client title must be use alphabatic character";

                }else{
                  $select_sql   = "SELECT * FROM clients WHERE client_name='$client_name' AND client_occupation='$client_occupation'";
                  $select_query = mysqli_query($connect,$select_sql);
                  $count_row    = mysqli_num_rows($select_query);
                  if ($count_row >= 1) {
                    $_SESSION['error'] = "client name and client occupation is already exists ! please try to anther client title";

                  }else{
                     $insert_sql = "INSERT INTO clients(client_name,client_comments,client_occupation,status) VALUES ('$client_name','$client_comments','$client_occupation','0')";

                    $insert_query = mysqli_query($connect,$insert_sql);
                    $last_id      = mysqli_insert_id($connect);
                    $file_name    = $last_id.'.'.$extension;
                    $destination  = '../../uploads/clients-photos/'.$file_name;

                    if (move_uploaded_file($client_photo['tmp_name'],$destination)) {
                      $update_client = "UPDATE clients SET client_photo='$file_name' WHERE id='$last_id'";
                      $update_query  = mysqli_query($connect,$update_client);

                      if ($update_query) {
                         $_SESSION['success'] = "client insert has been successfully complated";
                         header("location: client-list.php");

                       }else{
                         $_SESSION['error'] = "Ooops !!, client does not insert.please try again";
                       }
                    }else{
                         $_SESSION['error'] = "client photo does not uploaded";

                    }
                    
                  }
                }
                
            }

          $title = "client create page";

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
                                      <div class="card-header bg-success text-white clearfix"><b class="float-left">Add New client</b><a href="client-list.php" class="btn btn-warning float-right">Back to client list</a></div>
                                            <div class="card-box">
                                             <form action="" method="post" enctype="multipart/form-data">

                                                <div class="row">
                                                  <div class="col-md-4">
                                                      <div class="form-group">
                                                          <label for="title" class="text-white">client Name</label>
                                                          <div class="input-group">
                                                            <div class="input-group-append">
                                                              <span class="input-group-text"><i class=" fas fa-globe"></i></span>
                                                            </div>
                                                            <input type="text" name="client_name" class="form-control" id="client_title"  placeholder="client name" value="<?php if(isset($_POST['client_name'])){echo $_POST['client_name']; } ?>">
                                                          </div> 
                                                      </div>
                                                  </div>
                                          
                                                    <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label for="title" class="text-white">Client Occupation</label>
                                                        <div class="input-group">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fas fa-heart"></i></span>
                                                          </div>
                                                          <input type="text" name="client_occupation" class="form-control" id="greeting"  placeholder="client occupation" value="<?php if(isset($_POST['client_occupation'])){echo $_POST['client_occupation']; } ?>">
                                                        </div> 
                                                      </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label class="text-white">Choose client Photo</label>
                                                        <div class="input-group">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text">
                                                              <i class="fa fa-photo"></i>
                                                            </span>
                                                          </div>
                                                          <input type="file" name="client_photo" class="form-control form-control-file">
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                  <label class="text-white">client Comments</label>
                                                  <div class="input-group">
                                                    <div class="input-group-append">
                                                      <span class="input-group-text"><i class="fa fa-male"></i></span>
                                                    </div>
                                                    <textarea name="client_comments" class="form-control" cols="5" rows="5" placeholder="client Comments"><?php 
                                                   if (isset($_POST['client_comments'])) {
                                                      echo $_POST['client_comments'];
                                                    } ?></textarea>
                                                  </div>
                                                </div>
               
                                
                                                <div class="form-group">
                                                  <button type="submit" name="add-client" class="btn btn-pink w-50">Add client </button>
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
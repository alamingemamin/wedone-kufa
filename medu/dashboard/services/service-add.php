        <?php  session_start();  ?>

              <?php include "../auth_check.php"; ?>
              
              <?php

              require "../../includes/database.php";  
              if (isset($_POST['add-service'])) {
                $service_icon            = $_POST['service_icon'];
                $service_title           = $_POST['service_title'];
                $service_description     = htmlentities($_POST['service_description']);
                $service_icon_color      = $_POST['service_icon_color'];
                
                if (empty($service_icon)) {
                  $_SESSION['error'] = "Service icon is required";

                }elseif (empty($service_title)) {
                  $_SESSION['error'] = "Service Title is required";

                }elseif (empty($service_description)) {
                  $_SESSION['error'] = "Service description is required";

                }elseif (is_numeric($service_icon)) {
                  $_SESSION['error'] = "Service icon must be use alphabatic character";

                }elseif (is_numeric($service_title)) {
                  $_SESSION['error'] = "Service title must be use alphabatic character";

                }else{
                  $select_sql   = "SELECT * FROM services WHERE service_title='$service_title'";
                  $select_query = mysqli_query($connect,$select_sql);
                  $count_row    = mysqli_num_rows($select_query);
                  if ($count_row >= 1) {
                    $_SESSION['error'] = "Service name is already exists ! please try to anther email";

                  }else{
                    $insert_sql = "INSERT INTO services(service_icon,service_icon_color,service_title,service_description,status) VALUES ('$service_icon','$service_icon_color','$service_title','$service_description','0')";
                    $insert_query = mysqli_query($connect,$insert_sql);
                    if ($insert_query) {
                       $_SESSION['success'] = "Service insert has been successfully complated";
                       header("location: service-list.php");
                    }else{
                      $_SESSION['error'] = "Ooops !!, Service does not insert.please try again";
                    }
                  }
                }
                
            }

          $title = "Service create page";

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
                                      <div class="card-header bg-success text-white clearfix"><b class="float-left">Add New Service</b><a href="service-list.php" class="btn btn-warning float-right">Back to service list</a></div>
                                            <div class="card-box">
                                             <form action="" method="post">

                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="icon" class="text-white">Service icon</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-photo"></i></span>
                                                        </div>
                                                        <input type="text" name="service_icon" class="form-control" id="service_icon"  placeholder="fa fa-example" value="<?php if(isset($_POST['service_icon'])){echo $_POST['service_icon']; } ?>">
                                                      </div> 
                                                    </div>
                                                  </div>

                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="title" class="text-white">Service Title</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-service"></i></span>
                                                        </div>
                                                        <input type="text" name="service_title" class="form-control" id="service_title"  placeholder="service title" value="<?php if(isset($_POST['service_title'])){echo $_POST['service_title']; } ?>">
                                                      </div> 
                                                    </div>
                                                  </div>
                                                </div>


                                                  <div class="form-group">
                                                      <label for="title" class="text-white">Service Icon color</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fas fa-palette"></i></span>
                                                        </div>
                                                        <input type="color" name="service_icon_color" class="form-control" id="service_icon_color"  placeholder="service icon color" value="<?php if(isset($_POST['service_icon_color'])){echo $_POST['service_icon_color']; } ?>">
                                                      </div> 
                                                  </div>

                                                <div class="form-group">
                                                  <label class="text-white">Service Description</label>
                                                  <div class="input-group">
                                                    <div class="input-group-append">
                                                      <span class="input-group-text"><i class="fa fa-male"></i></span>
                                                    </div>
                                                    <textarea name="service_description" class="form-control" cols="5" rows="5" placeholder="service description"><?php 
                                                   if (isset($_POST['service_description'])) {
                                                      echo $_POST['service_description'];
                                                    } ?></textarea>
                                                  </div>
                                                </div>
               
                                
                                                <div class="form-group">
                                                  <button type="submit" name="add-service" class="btn btn-pink w-50">Add Service </button>
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
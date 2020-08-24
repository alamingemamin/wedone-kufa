<?php 

session_start();
include "../auth_check.php";
include "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$edit_sql   = "SELECT * FROM services WHERE id='$id'";
	$edit_query = mysqli_query($connect,$edit_sql);
	$edit_row   = mysqli_fetch_assoc($edit_query);
	
	
}else{
  header("location: service-list.php");
}


if (isset($_POST['update-service'])) {
                $service_icon            = $_POST['service_icon'];
                $service_title           = $_POST['service_title'];
                $service_description     = htmlentities($_POST['service_description']);
                $service_icon_color      = $_POST['service_icon_color'];
                $service_id              = $_POST['service_id'];       
                
                if (empty($service_icon)) {
                  $_SESSION['error'] = "Service icon is required";

                }elseif (empty($service_title)) {
                  $_SESSION['error'] = "Service Title is required";

                }elseif (empty($service_icon_color)) {
                  $_SESSION['error'] = "Service icon color is required";

                }
                elseif (empty($service_description)) {
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
                    $select_sql1   = "SELECT * FROM services WHERE service_title='$service_title' AND id='$service_id'";
                    $select_query1 = mysqli_query($connect,$select_sql1);
                    $count_row1    = mysqli_num_rows($select_query1);
                    if ($count_row1 >= 1) {
                        $update_sql = "UPDATE services SET service_icon='$service_icon',service_icon_color='$service_icon_color',service_title='$service_title',service_description='$service_description',status='0' WHERE id='$service_id'";

                        $update_query = mysqli_query($connect,$update_sql);
                        if ($update_query) {
                           $_SESSION['success'] = "Service Updated has been successfully complated";
                           header("location: service-list.php");
                        }else{
                          $_SESSION['error'] = "Ooops !!, Service does not Updated.please try again";
                        }

                    }else{
                       $_SESSION['error'] = "Service title is already exists ! please try to anther email";

                    }

                  }else{
                    $update_sql = "UPDATE services SET service_icon='$service_icon',service_icon_color='$service_icon_color',service_title='$service_title',service_description='$service_description',status='0' WHERE id='$service_id'";

                    $update_query = mysqli_query($connect,$update_sql);
                    if ($update_query) {
                       $_SESSION['success'] = "Service Updated has been successfully complated";
                       header("location: service-list.php");
                    }else{
                      $_SESSION['error'] = "Ooops !!, Service does not Updated.please try again";
                    }

                  }
                }
                
            }

$title = "Service edit page";


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
                                      <div class="card-header bg-success text-white clearfix"><b class="float-left">Update Service</b><a href="service-list.php" class="btn btn-warning float-right">Back to service list</a></div>
                                            <div class="card-box">
                                             <form action="" method="post">
                                                <input type="hidden" name="service_id" value="<?= $edit_row['id'];?>">
                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="icon" class="text-white">Service icon</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-photo"></i></span>
                                                        </div>
                                                        <input type="text" name="service_icon" class="form-control" id="service_icon"  value="<?= $edit_row['service_icon']; ?>">
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
                                                        <input type="text" name="service_title" class="form-control" id="service_title" value="<?= $edit_row['service_title'] ?>">
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
                                                        <input type="color" name="service_icon_color" class="form-control" id="service_icon_color"  value="<?= $edit_row['service_icon_color']; ?>">
                                                      </div> 
                                                  </div>

                                                <div class="form-group">
                                                  <label class="text-white">Service Description</label>
                                                  <div class="input-group">
                                                    <div class="input-group-append">
                                                      <span class="input-group-text"><i class="fa fa-male"></i></span>
                                                    </div>
                                                    <textarea name="service_description" class="form-control" cols="5" rows="5"><?= $edit_row['service_description']; ?></textarea>
                                                  </div>
                                                </div>
               
                                
                                                <div class="form-group">
                                                  <button type="submit" name="update-service" class="btn btn-pink w-50">Update Service </button>
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
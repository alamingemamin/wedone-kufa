<?php  session_start();  ?>

<?php include "../auth_check.php"; ?>

<?php 
require "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];
    $select_banner_icon = "SELECT * FROM banner_icons WHERE id='$id'";
    $select_banner_icon_query = mysqli_query($connect,$select_banner_icon);
    $select_banner_icon_row   = mysqli_fetch_assoc($select_banner_icon_query);
}





 ?>



 <?php

                
              if (isset($_POST['update-banner_icon'])) {
                $banner_icon_name   = $_POST['banner_icon_name'];
                $banner_icon_link   = $_POST['banner_icon_link'];
                $banner_icon_color  = $_POST['banner_icon_color'];
                $banner_id          = $_POST['banner_id'];
                $banner_icon_id     = $_POST['id'];
                
                
                if (empty($banner_icon_name)) {
                  $_SESSION['error'] = "banner icon name is required";

                }elseif (empty($banner_icon_link)) {
                  $_SESSION['error'] = "banner icon link is required";

                }elseif (empty($banner_icon_color)) {
                  $_SESSION['error'] = "banner icon color is required";

                }elseif (is_numeric($banner_icon_name)) {
                  $_SESSION['error'] = "banner icon name be use alphabatic character";

                }else{
                  
                     $update_sql = "UPDATE banner_icons SET banner_icon_name='$banner_icon_name', banner_icon_color='$banner_icon_color' , banner_icon_link='$banner_icon_link' , banner_id='$banner_id' WHERE id='$banner_icon_id'";

                    $update_query = mysqli_query($connect,$update_sql);
                     
                    if ($update_query) {
                         $_SESSION['success'] = "banner icon update has been successfully complated";
                         header("location: banner-icons-list.php");

                    }else{
                         $_SESSION['error'] = "Ooops !!, banner does not update.please try again";
                    }
                    
                  
                }
                
            }

          $title = "banner icons create page";

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
                                      <div class="card-header bg-success text-white clearfix"><b class="float-left">Edit banner icon</b><a href="banner-icons-list.php" class="btn btn-warning float-right">Back to banner icon list</a></div>
                                            <div class="card-box">
                                             <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?= $select_banner_icon_row['id'];?>">
                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="title" class="text-white">Banner icon Name</label>
                                                          <div class="input-group">
                                                            <div class="input-group-append">
                                                              <span class="input-group-text"><i class=" fas fa-globe"></i></span>
                                                            </div>
                                                            <input type="text" name="banner_icon_name" class="form-control" id="banner_title"  placeholder="fa fa-example"
                                                            value="<?= $select_banner_icon_row['banner_icon_name'];?>">
                                                          </div> 
                                                      </div>
                                                  </div>
                                          
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label for="title" class="text-white">Banner icon link</label>
                                                        <div class="input-group">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fas fa-link"></i></span>
                                                          </div>
                                                          <input type="text" name="banner_icon_link" class="form-control" id="greeting"  placeholder="https://example.com" value="<?= $select_banner_icon_row['banner_icon_link']; ?>">
                                                        </div> 
                                                      </div>
                                                    </div>
                                                    
                                                </div>

                                                <div class="row">
                                                  <div class="col-md-6">
                                                    
                                                      <div class="form-group">
                                                        <label class="text-white">Choose Banner icon color</label>
                                                        <div class="input-group">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text">
                                                              <i class="fa fa-paint"></i>
                                                            </span>
                                                          </div>
                                                          <input type="color" name="banner_icon_color" class="form-control form-control-file" value="<?= $select_banner_icon_row['banner_icon_color'];?>">
                                                        </div>
                                                      
                                                    </div>
                                                  </div>

                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="text-white">Choose Parent Bannar</label>
                                                    <div class="input-group">
                                                      <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-logo"></i></span>
                                                      </div>
                                                      <?php  

                                                      $select_banner = "SELECT * FROM banners";
                                                      $select_query  = mysqli_query($connect,$select_banner);
                                                      
                                                      ?>
                                                      <select name="banner_id" required="" class="form-control">
                                                      	<option value="<?= $select_banner_icon_row['id']?>"><?= $select_banner_icon_row['banner_id'];?></option>
                                                        <?php while ($select_row = mysqli_fetch_assoc($select_query)) { ?>
                                                          <option value="<?= $select_row['id']?>"><?= $select_row['banner_title']?></option>
                                                        <?php } ?>
                                                      </select>
                                                    </div>
                                                  </div>
                                                  </div>
                                                </div>
                                
                                                <div class="form-group">
                                                  <button type="submit" name="update-banner_icon" class="btn btn-pink w-50">Update banner icon </button>
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
        <?php  session_start();  ?>

              <?php include "../auth_check.php"; ?>
              
              <?php

              require "../../includes/database.php";  
              if (isset($_POST['add-banner_icon'])) {
                $banner_icon_name   = $_POST['banner_icon_name'];
                $banner_icon_link   = $_POST['banner_icon_link'];
                $banner_icon_color  = $_POST['banner_icon_color'];
                $banner_id          = $_POST['banner_id'];

                
                
                if (empty($banner_icon_name)) {
                  $_SESSION['error'] = "banner icon name is required";

                }elseif (empty($banner_icon_link)) {
                  $_SESSION['error'] = "banner icon link is required";

                }elseif (empty($banner_icon_color)) {
                  $_SESSION['error'] = "banner icon color is required";

                }elseif (is_numeric($banner_icon_name)) {
                  $_SESSION['error'] = "banner icon name be use alphabatic character";

                }else{
                  
                     $insert_sql = "INSERT INTO banner_icons(banner_icon_name,banner_icon_color,banner_icon_link,banner_id) VALUES ('$banner_icon_name','$banner_icon_color','$banner_icon_link','$banner_id')";

                    $insert_query = mysqli_query($connect,$insert_sql);
                     
                    if ($insert_query) {
                         $_SESSION['success'] = "banner icon insert has been successfully complated";
                         header("location: banner-icons-list.php");

                    }else{
                         $_SESSION['error'] = "Ooops !!, banner does not insert.please try again";
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
                                      <div class="card-header bg-success text-white clearfix"><b class="float-left">Add New banner icon</b><a href="banner-icons-list.php" class="btn btn-warning float-right">Back to banner icon list</a></div>
                                            <div class="card-box">
                                             <form action="" method="post" enctype="multipart/form-data">

                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="title" class="text-white">Banner icon Name</label>
                                                          <div class="input-group">
                                                            <div class="input-group-append">
                                                              <span class="input-group-text"><i class=" fas fa-globe"></i></span>
                                                            </div>
                                                            <input type="text" name="banner_icon_name" class="form-control" id="banner_title"  placeholder="fa fa-example" value="<?php if(isset($_POST['banner_icon_name'])){echo $_POST['banner_icon_name']; } ?>">
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
                                                          <input type="text" name="banner_icon_link" class="form-control" id="greeting"  placeholder="https://example.com" value="<?php if(isset($_POST['banner_icon_link'])){echo $_POST['banner_icon_link']; } ?>">
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
                                                          <input type="color" name="banner_icon_color" class="form-control form-control-file">
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
                                                        <?php while ($select_row = mysqli_fetch_assoc($select_query)) { ?>
                                                          <option value="<?= $select_row['id']?>"><?= $select_row['banner_title']?></option>
                                                        <?php } ?>
                                                      </select>
                                                    </div>
                                                  </div>
                                                  </div>
                                                </div>
                                
                                                <div class="form-group">
                                                  <button type="submit" name="add-banner_icon" class="btn btn-pink w-50">Add banner icon </button>
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
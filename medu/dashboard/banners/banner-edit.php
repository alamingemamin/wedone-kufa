<?php 

session_start();
include "../auth_check.php";
include "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$edit_sql   = "SELECT * FROM banners WHERE id='$id'";
	$edit_query = mysqli_query($connect,$edit_sql);
	$edit_row   = mysqli_fetch_assoc($edit_query);
	
	
}else{
  header("location: banner-list.php");
}


if (isset($_POST['update-banner'])) {
                $banner_title           = mysqli_real_escape_string($connect,trim($_POST['banner_title']));
                $banner_description     = mysqli_real_escape_string($connect,trim(htmlentities($_POST['banner_description'])));
                $banner_id              = $_POST['banner_id'];
                $banner_greeting        = mysqli_real_escape_string($connect,trim($_POST['greeting']));      
                
                
                if (empty($banner_title)) {
                  $_SESSION['error'] = "banner Title is required";

                }elseif (empty($banner_greeting)) {
                  $_SESSION['error'] = "banner greeting is required";

                }
                elseif (empty($banner_description)) {
                  $_SESSION['error'] = "banner description is required";

                }elseif (is_numeric($banner_title)) {
                  $_SESSION['error'] = "banner title must be use alphabatic character";

                }else{
                  $select_sql   = "SELECT * FROM banners WHERE banner_title='$banner_title'";
                  $select_query = mysqli_query($connect,$select_sql);
                  $count_row    = mysqli_num_rows($select_query);
                  if ($count_row >= 1) {

                    $select_sql1   = "SELECT * FROM banners WHERE banner_title='$banner_title' AND id='$banner_id'";
                    $select_query1 = mysqli_query($connect,$select_sql1);
                    $count_row1    = mysqli_num_rows($select_query1);

                    if ($count_row1 >= 1) {
                      $update_sql = "UPDATE banners SET banner_greeting='$banner_greeting' ,banner_title='$banner_title',banner_description='$banner_description',status='0' WHERE id='$banner_id'";

                      $update_query = mysqli_query($connect,$update_sql);
                      if ($update_query) {
                         $_SESSION['success'] = "banner Updated has been successfully complated";
                         header("location: banner-list.php");

                      }else{
                        $_SESSION['error'] = "Ooops !!, banner does not Updated.please try again";
                      }
                    }else{
                       $_SESSION['error'] = "banner title is already exists ! please try to anther banner title";

                    }

                  }else{
                    $update_sql = "UPDATE banners SET banner_greeting='$banner_greeting' ,banner_title='$banner_title',banner_description='$banner_description',status='0' WHERE id='$banner_id'";

                    $update_query = mysqli_query($connect,$update_sql);
                    if ($update_query) {
                       $_SESSION['success'] = "banner Updated has been successfully complated";
                       header("location: banner-list.php");

                    }else{
                      $_SESSION['error'] = "Ooops !!, banner does not Updated.please try again";
                    }

                  }
                }
                
            }

$title = "banner edit page";


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
                                      <div class="card-header bg-success text-white clearfix"><b class="float-left">Update banner</b><a href="banner-list.php" class="btn btn-warning float-right">Back to banner list</a></div>
                                            <div class="card-box">
                                             <form action="" method="post">
                                                <input type="hidden" name="banner_id" value="<?= $edit_row['id'];?>">
                                                

                                                <div class="row">
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label for="title" class="text-white">Greetings</label>
                                                        <div class="input-group">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fas fa-heart"></i></span>
                                                          </div>
                                                          <input type="text" name="greeting" class="form-control" id="greeting"  placeholder="example Hello" value="<?= $edit_row['banner_greeting']; ?>">
                                                      </div> 
                                                    </div>
                                                  </div>

                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="title" class="text-white">banner Title</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-banner"></i></span>
                                                        </div>
                                                        <input type="text" name="banner_title" class="form-control" id="banner_title" value="<?= $edit_row['banner_title']; ?>">
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
                                                    <textarea name="banner_description" class="form-control" cols="5" rows="5"><?= $edit_row['banner_description']; ?></textarea>
                                                  </div>
                                                </div>
               
                                
                                                <div class="form-group">
                                                  <button type="submit" name="update-banner" class="btn btn-pink w-50">Update banner </button>
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
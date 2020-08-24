<?php 

session_start();
include "../auth_check.php";
include "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$edit_sql   = "SELECT * FROM facts WHERE id='$id'";
	$edit_query = mysqli_query($connect,$edit_sql);
	$edit_row   = mysqli_fetch_assoc($edit_query);
	
	
}else{
  header("location: fact-list.php");
}


if (isset($_POST['update-fact'])) {
                $fact_icon            = mysqli_real_escape_string($connect,trim($_POST['fact_icon']));
                $fact_title           = mysqli_real_escape_string($connect,trim($_POST['fact_title']));
                $fact_count           = mysqli_real_escape_string($connect,trim($_POST['fact_count']));
                $fact_icon_color      = $_POST['fact_icon_color'];
                $fact_id              = $_POST['fact_id'];       
                
                if (empty($fact_icon)) {
                  $_SESSION['error'] = "fact icon is required";

                }elseif (empty($fact_title)) {
                  $_SESSION['error'] = "fact Title is required";

                }elseif (empty($fact_icon_color)) {
                  $_SESSION['error'] = "fact icon color is required";

                }
                elseif (empty($fact_count)) {
                  $_SESSION['error'] = "fact description is required";

                }elseif (is_numeric($fact_icon)) {
                  $_SESSION['error'] = "fact icon must be use alphabatic character";

                }elseif (is_numeric($fact_title)) {
                  $_SESSION['error'] = "fact title must be use alphabatic character";

                }else{
                  $select_sql   = "SELECT * FROM facts WHERE fact_title='$fact_title'";
                  $select_query = mysqli_query($connect,$select_sql);
                  $count_row    = mysqli_num_rows($select_query);

                  if ($count_row >= 1) {
                    $select_sql1   = "SELECT * FROM facts WHERE fact_title='$fact_title' AND id='$fact_id'";
                    $select_query1 = mysqli_query($connect,$select_sql1);
                    $count_row1   = mysqli_num_rows($select_query1);

                    if ($count_row1 >= 1) {
                       $update_sql = "UPDATE facts SET fact_icon='$fact_icon',fact_icon_color='$fact_icon_color',fact_title='$fact_title',fact_count='$fact_count',status='0' WHERE id='$fact_id'";

                        $update_query = mysqli_query($connect,$update_sql);
                        if ($update_query) {
                           $_SESSION['success'] = "fact Updated has been successfully complated";
                           header("location: fact-list.php");

                        }else{
                          $_SESSION['error'] = "Ooops !!, fact does not Updated.please try again";
                          
                        }
                    }else{
                      $_SESSION['error'] = "fact title is already exists ! please try to anther Title";
                    }
                    

                  }else{
                    $update_sql = "UPDATE facts SET fact_icon='$fact_icon',fact_icon_color='$fact_icon_color',fact_title='$fact_title',fact_count='$fact_count',status='0' WHERE id='$fact_id'";

                    $update_query = mysqli_query($connect,$update_sql);
                    if ($update_query) {
                       $_SESSION['success'] = "fact Updated has been successfully complated";
                       header("location: fact-list.php");

                    }else{
                      $_SESSION['error'] = "Ooops !!, fact does not Updated.please try again";
                      
                    }

                  }

                }
                
            }

$title = "fact edit page";


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
                                      <div class="card-header bg-success text-white clearfix"><b class="float-left">Update fact</b><a href="fact-list.php" class="btn btn-warning float-right">Back to fact list</a></div>
                                            <div class="card-box">
                                             <form action="" method="post">
                                                <input type="hidden" name="fact_id" value="<?= $edit_row['id'];?>">
                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="icon" class="text-white">fact icon</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-photo"></i></span>
                                                        </div>
                                                        <input type="text" name="fact_icon" class="form-control" id="fact_icon"  value="<?= $edit_row['fact_icon']; ?>">
                                                      </div> 
                                                    </div>
                                                  </div>

                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="title" class="text-white">fact Title</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-fact"></i></span>
                                                        </div>
                                                        <input type="text" name="fact_title" class="form-control" id="fact_title" value="<?= $edit_row['fact_title'] ?>">
                                                      </div> 
                                                    </div>
                                                  </div>
                                                </div>


                                                  <div class="form-group">
                                                      <label for="title" class="text-white">fact Icon color</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fas fa-palette"></i></span>
                                                        </div>
                                                        <input type="color" name="fact_icon_color" class="form-control" id="fact_icon_color"  value="<?= $edit_row['fact_icon_color']; ?>">
                                                      </div> 
                                                  </div>

                                                <div class="form-group">
                                                  <label class="text-white">fact Count</label>
                                                  <div class="input-group">
                                                    <div class="input-group-append">
                                                      <span class="input-group-text"><i class="fa fa-male"></i></span>
                                                    </div>
                                                    <input type="number" name="fact_count" class="form-control" id="fact_count" value="<?= $edit_row['fact_count']; ?>">
                                                  </div>
                                                </div>
               
                                
                                                <div class="form-group">
                                                  <button type="submit" name="update-fact" class="btn btn-pink w-50">Update fact </button>
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
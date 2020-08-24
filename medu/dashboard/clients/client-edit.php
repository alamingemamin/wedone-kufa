<?php 

session_start();
include "../auth_check.php";
include "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];


	$edit_sql   = "SELECT * FROM clients WHERE id='$id'";
	$edit_query = mysqli_query($connect,$edit_sql);
	$edit_row   = mysqli_fetch_assoc($edit_query);
	
	
}else{
  header("location: client-list.php");
}


if (isset($_POST['update-client'])) {
                $client_name        = mysqli_real_escape_string($connect,trim($_POST['client_name']));
                $client_comments    = mysqli_real_escape_string($connect,trim(htmlentities($_POST['client_comments'])));
                $client_id          = $_POST['client_id'];
                $client_occupation  = mysqli_real_escape_string($connect,trim($_POST['client_occupation']));      
                
                
                if (empty($client_name)) {
                  $_SESSION['error'] = "client name is required";

                }elseif (empty($client_occupation)) {
                  $_SESSION['error'] = "client occupation is required";

                }
                elseif (empty($client_comments)) {
                  $_SESSION['error'] = "client comments is required";

                }elseif (is_numeric($client_name)) {
                  $_SESSION['error'] = "client name must be use alphabatic character";

                }else{
                  $select_sql   = "SELECT * FROM clients WHERE client_title='$client_title'";
                  $select_query = mysqli_query($connect,$select_sql);
                  $count_row    = mysqli_num_rows($select_query);
                  
                  if ($count_row >= 1) {
                    $_SESSION['error'] = "client name is already exists ! please try to anther client title";

                  }else{
                    $update_sql = "UPDATE clients SET client_name='$client_name' ,client_comments='$client_comments',client_occupation='$client_occupation',status='0' WHERE id='$client_id'";

                    $update_query = mysqli_query($connect,$update_sql);
                    if ($update_query) {
                       $_SESSION['success'] = "client Updated has been successfully complated";
                       header("location: client-list.php");

                    }else{
                      $_SESSION['error'] = "Ooops !!, client does not Updated.please try again";
                    }
                  }
                }
                
            }

$title = "client edit page";


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
                                      <div class="card-header bg-success text-white clearfix"><b class="float-left">Update client</b><a href="client-list.php" class="btn btn-warning float-right">Back to client list</a></div>
                                            <div class="card-box">
                                             <form action="" method="post">
                                                <input type="hidden" name="client_id" value="<?= $edit_row['id'];?>">
                                                

                                                <div class="row">
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label for="title" class="text-white">Client Name</label>
                                                        <div class="input-group">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fas fa-heart"></i></span>
                                                          </div>
                                                          <input type="text" name="client_name" class="form-control" id="greeting"  placeholder="example Hello" value="<?= $edit_row['client_name']; ?>">
                                                      </div> 
                                                    </div>
                                                  </div>

                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="title" class="text-white">client Occupation</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-client"></i></span>
                                                        </div>
                                                        <input type="text" name="client_occupation" class="form-control" id="client_title" value="<?= $edit_row['client_occupation']; ?>">
                                                      </div> 
                                                    </div>
                                                  </div>
                                                </div>


                                                <div class="form-group">
                                                  <label class="text-white">client comments</label>
                                                  <div class="input-group">
                                                    <div class="input-group-append">
                                                      <span class="input-group-text"><i class="fa fa-male"></i></span>
                                                    </div>
                                                    <textarea name="client_comments" class="form-control" cols="5" rows="5"><?= $edit_row['client_comments']; ?></textarea>
                                                  </div>
                                                </div>
               
                                
                                                <div class="form-group">
                                                  <button type="submit" name="update-client" class="btn btn-pink w-50">Update client </button>
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
<?php session_start(); ?>

<?php

include "../auth_check.php"; 

require "../../includes/database.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$edit_sql   = "SELECT * FROM users WHERE id='$id'";
	$edit_query = mysqli_query($connect,$edit_sql);
	if ($edit_query) {
		$edit_row = mysqli_fetch_assoc($edit_query);

	}else{
		$_SESSION['error'] = "OOpss !! no data here.query failed";

	}
}else{
	header("location: all_users.php");
}
?>

            <?php
              if (isset($_POST['update'])) {
                $name      = $_POST['name'];
                $gender    = $_POST['gender'];
                $email     = $_POST['email'];
                $update_id = $_POST['id'];

                if (empty($name)) {
                  $_SESSION['error'] = "Name is required";

                }elseif (empty($gender)) {
                  $_SESSION['error'] = "Gender name is required";

                }elseif (empty($email)) {
                  $_SESSION['error'] = "Email name is required";

                }elseif (is_numeric($name)) {
                  $_SESSION['error'] = "name must be use alphabatic character";


                }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                  $_SESSION['error'] = "Email name must be use a valid email";

                }else{
                  $select_sql   = "SELECT * FROM users WHERE email='$email'";
                  $select_query = mysqli_query($connect,$select_sql);
                  $count_row    = mysqli_num_rows($select_query);

                  if ($count_row == 1) {
                    $_SESSION['error'] = "Email is already exists ! please try to anther email";
                  }else{
                  
                    $update_sql = "UPDATE users SET name='$name',role='0',gender='$gender',email='$email' WHERE id='$update_id'";
              
                    $update_query = mysqli_query($connect,$update_sql);
                    
                    if ($update_query) {
                       $_SESSION['success'] = "User updated has been successfully complated";
                       header("location: all_users.php");

                    }else{
                      $_SESSION['error'] = "Ooops !!, User does not update.please try again";

                    }
                  }
                }
                
            }

$title = "User edit page";
?>


<?php include "../../includes/layouts/header.php"; ?>

        <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                               <div class="">
                                <?php  if (isset($_SESSION['error'])): ?>


                                  <script type="text/javascript">
                                    Swal.fire({
                                      icon: 'error',
                                      html:'<p><b class="text-danger"><i class="fa fa-warning"></i></b>&nbsp&nbsp&nbsp<span class="text-warning"><?php echo $_SESSION['error']; ?></span></p>',
                                    })
                                  </script>

                                 <?php endif; unset($_SESSION['error']); ?>

                                      <div class="card-header text-center bg-success text-white"><b>User Edit form</b></div>
                                            <div class="card-box">
                                             <form action="" method="post">
                                                <input type="hidden" name="id" value="<?= $edit_row['id'];?>">
                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="name" class="text-white"> Name</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                        </div>
                                                        <input type="text" name="name" class="form-control" id="name"  placeholder="Enter first name" value="<?= $edit_row['name']?>">
                                                      </div> 
                                                    </div>
                                                  </div>

                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="lname" class="text-white">Name</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                        </div>
                                                        <input type="text" disabled="" name="lname" class="form-control" id="lname"  placeholder="Enter last name" value="<?= $edit_row['name']?>">
                                                      </div> 
                                                    </div>
                                                  </div>
                                                </div>

                                        
                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label class="text-white">Gender</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-id-badge"></i></span>
                                                        </div>
                                                        <select name="gender" class="form-control">
                                                          <option value="<?= $edit_row['gender'];?>"><?= ucwords($edit_row['gender']);?></option>
                                                          <option value="male"
                                                           <?php if(isset($_POST['gender']) == "male"){ echo "selected"; }?> >Male
                                                          </option>
                                                          <option value="female">Female
                                                          </option>
                                                        </select>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="email" class="text-white">Email address</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-at"></i></span>
                                                         </div>
                                                        <input type="email" name="email" class="form-control" id="email"  placeholder="Enter email" value="<?= $edit_row['email']?>">
                                                      </div> 
                                                    </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password" class="text-white">Password</label>
                                                        <div class="input-group">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                                                          </div>
                                                          <input type="password" disabled="" name="password" id="password" placeholder="Password" class="form-control" value="<?= $edit_row['password']; ?>">
                                                          <div class="input-group-prepend">
                                                            <span class="input-group-text"><b id="click_icon" style="cursor: pointer;"><i id="icon" class="fa fa-eye"></i></b></span>
                                                          </div>
                                                        </div>
                                                      </div>

                                                  </div>
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password" class="text-white">Confrim Password</label>
                                                        <div class="input-group">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                                                          </div>
                                                          <input type="password" disabled="" name="cpassword" id="cpassword" placeholder="Password" class="form-control" value="<?= $edit_row['password']; ?>">
                                                          <div class="input-group-prepend">
                                                            <span class="input-group-text"><b id="click_icon_c" style="cursor: pointer;"><i id="cicon" class="fa fa-eye"></i></b></span>
                                                          </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                  <button type="submit" name="update" class="btn btn-pink col-md-6 m-auto">Update </button>
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


<?php include "../../includes/layouts/footer.php"; ?>
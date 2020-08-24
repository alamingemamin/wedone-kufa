        <?php  session_start();  ?>

              
              <?php

              require "includes/database.php"; 


              $select_setting = "SELECT * FROM settings LIMIT 1";
              $select_query   = mysqli_query($connect,$select_setting);
              $setting_row    = mysqli_fetch_assoc($select_query);



              if (isset($_POST['registration'])) {
                $fname     = mysqli_real_escape_string($connect,trim($_POST['fname']));
                $lname     = mysqli_real_escape_string($connect,trim($_POST['lname']));
                $role      = mysqli_real_escape_string($connect,trim($_POST['role']));
                $gender    = mysqli_real_escape_string($connect,trim($_POST['gender']));
                $email     = mysqli_real_escape_string($connect,trim($_POST['email']));
                $password  = mysqli_real_escape_string($connect,trim($_POST['password']));
                $cpassword = mysqli_real_escape_string($connect,trim($_POST['cpassword']));
                $user_photo = $_FILES['user_photo'];
                $explode   =  (explode('.',$user_photo['name']));
                $extension =  strtolower(end($explode));
                $allowed   = array('jpg','jpeg','png','gif');

                if (empty($fname)) {
                  $_SESSION['error'] = "First name is required";
                }elseif (empty($lname)) {
                  $_SESSION['error'] = "Last name is required";
                }elseif (empty($gender)) {
                  $_SESSION['error'] = "Gender name is required";
                }elseif (empty($email)) {
                  $_SESSION['error'] = "Email name is required";
                }elseif (empty($password)) {
                  $_SESSION['error'] = "password name is required";

                }elseif (is_numeric($fname)) {
                  $_SESSION['error'] = "First name must be use alphabatic character";

                }elseif (is_numeric($lname)) {
                  $_SESSION['error'] = "Last name must be use alphabatic character";

                }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                  $_SESSION['error'] = "Email name must be use a valid email";

                }elseif (strlen($password) < 7 || strlen($password) > 32) {
                  $_SESSION['error'] = "Password must be use between minimum 8 and maximum 32 character";

                }elseif (!preg_match('/[&,$,#,^,*]/', $password)) {
                  $_SESSION['error'] = "Password use number , letter , and special character";

                }elseif ($password != $cpassword) {
                  $_SESSION['error'] = "Password and Confirm Password Does not match";

                }elseif (!in_array($extension,$allowed)) {
                  $_SESSION['error'] = "Your file format does not support";

                }elseif ($user_photo['size'] > (1024*1024)) {
                  $_SESSION['error'] = "you file is too large!!";
                  
                }else{
                  $select_sql   = "SELECT * FROM users WHERE email='$email' AND role='$role'";
                  $select_query = mysqli_query($connect,$select_sql);
                  $count_row    = mysqli_num_rows($select_query);
                  if ($count_row >= 1) {
                    $_SESSION['error'] = "Email is already exists ! please try to anther email";

                  }else{
                    $name     = $fname.' '.$lname;
                    $username = $fname.$lname;
                    $vkey     = md5(time().$username);
                    $hash     = password_hash($password,PASSWORD_DEFAULT);

                    $insert_sql = "INSERT INTO users(name,gender,role,email,password,vkey) VALUES ('$name','$gender','$role','$email','$hash','$vkey')";
                    $insert_query = mysqli_query($connect,$insert_sql);

                    $last_id = mysqli_insert_id($connect);
                    $file_name = $last_id.'.'.$extension;

                    $location  = "uploads/users-photos/".$file_name;
                    if (move_uploaded_file($user_photo['tmp_name'], $location)) {
                      $update_user = "UPDATE users SET user_photo='$file_name' WHERE id='$last_id'";
                      $update_query = mysqli_query($connect,$update_user);

                      if ($update_query) {
                        $to = $email;
                        $subject = "Email varification";
                        $message = "<a href='http://localhost/medu/verify.php'>Verify Registration</a><br><p>Your Verification code: $vkey</p>";
                        $headers  = "From: alamingemamin@gmail.com \r\n";
                        $headers .= "MIME-Version: 1.0"."\r\n";
                        $headers .= "Content-type: text/html;charset=UTF-8"."\r\n";

                        if (mail($to,$subject,$message,$headers)) {
                          $_SESSION['success'] = "User registration has been successfully complated";
                          header("location: thanks.php?email=".$email);
                        }else{
                          $_SESSION['error'] = "Email does not send";
                        }
                       
                       
                    }else{
                      $_SESSION['error'] = "Ooops !!, User does not insert.please try again";
                    }
                    }
                    
                  }
                }
                
            }



          ?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <title>User Registration page</title>
  </head>
  <body  style="background-image: radial-gradient(circle farthest-corner at -3.1% -4.3%, rgba(57,255,186,1) 0%,rgba(21,38,32,1) 90%);color:white; overflow-x: hidden;">
     

           <?php  if (isset($_SESSION['error'])): ?>


            <script type="text/javascript">
              Swal.fire({
                icon: 'error',
                html:'<p><b class="text-danger"><i class="fa fa-warning"></i></b>&nbsp&nbsp&nbsp<span class="text-warning"><?php echo $_SESSION['error']; ?></span></p>',
              })
            </script>

           <?php endif; unset($_SESSION['error']); ?>

           <!-- Start Page content -->
                        <div class="row" style="height: 100vh">
                            <div class="col-md-6 m-auto">
                                
                                  
                                  <div class="">
                                      <div class="card-header bg-success text-white clearfix"><b class="float-left">Registration form</b><a href="login.php" class="btn btn-success btn-sm float-right">Back to Login</a></div>
                                            <div class="card-box">
                                             <form action="" method="post" enctype="multipart/form-data">

                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="fname" class="text-white">First Name</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                        </div>
                                                        <input type="text" name="fname" class="form-control" id="fname"  placeholder="Enter first name" value="<?php if(isset($_POST['fname'])){echo $_POST['fname']; } ?>">
                                                      </div> 
                                                    </div>
                                                  </div>

                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="lname" class="text-white">Last Name</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                        </div>
                                                        <input type="text" name="lname" class="form-control" id="lname"  placeholder="Enter last name" value="<?php if(isset($_POST['lname'])){echo $_POST['lname']; } ?>">
                                                      </div> 
                                                    </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label class="text-white">Roles</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-male"></i></span>
                                                        </div>
                                                        <select class="form-control" name="role">
                                                           <?php 
                                                            if($setting_row['register_role'] == '1.2.3'){
                                                            ?>

                                                            <option value="1">Admin</option>
                                                            <option value="2">Moderator</option>
                                                            <option value="3">Editor</option>

                                                            <?php }elseif($setting_row['register_role'] == '2.3'){ ?>

                                                            <option value="2">Moderator</option>
                                                            <option value="3">Editor</option>
                                                            
                                                            <?php }elseif($setting_row['register_role'] == '1.3'){ ?>

                                                            <option value="1">Admin</option>
                                                            <option value="3">Editor</option>

                                                            <?php }elseif($setting_row['register_role'] == '1.2'){ ?>

                                                            <option value="1">Admin</option>
                                                            <option value="2">Moderator</option>

                                                            <?php }elseif($setting_row['register_role'] == '1'){ ?>

                                                            <option value="1">Admin</option>

                                                            <?php }elseif($setting_row['register_role'] == '2'){ ?>

                                                            <option value="2">Moderator</option>                                                 
                                                            <?php }elseif($setting_row['register_role'] == '3'){ ?>

                                                            <option value="3">Editor</option>
                                                            <?php } ?>
                                                        </select>
                                                      </div>
                                                </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label class="text-white">Choose Photo</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-photo"></i></span>
                                                        </div>
                                                        <input type="file" name="user_photo" class="form-control">
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
                                                          <option>Select gender</option>
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
                                                        <input type="email" name="email" class="form-control" id="email"  placeholder="Enter email" value="<?php if(isset($_POST['email'])){echo $_POST['email']; } ?>">
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
                                                          <input type="password" name="password" id="password" placeholder="Password" class="form-control" value="<?php if(isset($_POST['password'])){ echo $_POST['password']; } ?>">
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
                                                          <input type="password" name="cpassword" id="cpassword" placeholder="Password" class="form-control" value="<?php if(isset($_POST['cpassword'])){ echo $_POST['cpassword']; } ?>">
                                                          <div class="input-group-prepend">
                                                            <span class="input-group-text"><b id="click_icon_c" style="cursor: pointer;"><i id="cicon" class="fa fa-eye"></i></b></span>
                                                          </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                  <button type="submit" name="registration" class="btn btn-info btn-sm col-md-6 m-auto">Registration </button>
                                                </div>
                                              </form>
                                         </div>
                                      
                                          <div class="card-footer text-center text-white mt-3">
                                            2020- <?php echo date('Y'); ?> &copy copyright Medu.com  All right reserved
                                          </div>
                                       </div>
                                     </div>
                                   </div>

                               
                            </div>
                        </div> 

           
    
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $("#click_icon").click(function(){
           $("#icon").toggleClass("fa-eye-slash");
           $("#icon").toggleClass("text-danger");
          var pass = $("#password");
          if (pass.attr("type") == "password") {
            pass.attr("type","text");
          }else{
            pass.attr("type","password");
          }
        });

        $("#click_icon_c").click(function(){
           $("#cicon").toggleClass("fa-eye-slash");
           $("#cicon").toggleClass("text-danger");
          var cpass = $("#cpassword");
          if (cpass.attr("type") == "password") {
            cpass.attr("type","text");
          }else{
            cpass.attr("type","password");
          }
        });
      });
    </script>
  </body>
</html>
    
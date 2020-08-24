
<?php
session_start();
include 'includes/database.php';


$select_setting = "SELECT * FROM settings LIMIT 1";
$select_query   = mysqli_query($connect,$select_setting);
$setting_row    = mysqli_fetch_assoc($select_query);

if (isset($_POST['login'])) {
  $email    = $_POST['email'];
  $password = $_POST['password'];
  $role     = $_POST['role'];

  $email_sql   = "SELECT * FROM users WHERE role='$role' AND email='$email' AND verified='1'";
  $email_query = mysqli_query($connect,$email_sql);
  $num_count   = mysqli_num_rows($email_query);
  if ($num_count == 1) {
    $row = mysqli_fetch_assoc($email_query);
    $hash_password =  $row['password'];

    if (password_verify($password,$hash_password)) {

       if ($setting_row['tf_auth'] == 1) {
          $tf_key  = rand(0,999999);
          $id      = $row['id'];
          $update_tf_key   = "UPDATE users SET tf_key='$tf_key' WHERE id='$id'";
          $update_tf_query = mysqli_query($connect,$update_tf_key);

          if ($update_tf_query) {
            $to      = $row['tf_email'];
            $subject = "Two Fector varification code";
            $message = "<p>Two fector Verification code: <b>$tf_key</b></p>";
            $headers  = "From: alamingemamin@gmail.com \r\n";
            $headers .= "MIME-Version: 1.0"."\r\n";
            $headers .= "Content-type: text/html;charset=UTF-8"."\r\n";

            if (mail($to,$subject,$message,$headers)) {
               $_SESSION['success']     = "Good.please check your email and verify your code";
               $_SESSION['user_email']  = $row['email'];
               header("location: tf-verify.php");
               
            }else{
              $_SESSION['error'] = "Two fector verification code does not send";
            }
          }else{
            $_SESSION['error'] = "Somthing went to wrong";
          }

       }else{
        $_SESSION['login_success'] = "Congratulations,Login has been successfully.";
        $_SESSION['user_id']       = $row['id'];
        $_SESSION['user_name']     = $row['name'];
        $_SESSION['user_email']    = $row['email'];
        $_SESSION['user_password'] = $row['password'];
        $_SESSION['user_role']     = $row['role'];
        $_SESSION['user_photo']    = $row['user_photo'];

        setcookie("username",$row['name'],time()+86400);
        header("location: dashboard/auth/index.php");
       }
        

    }else{
      $_SESSION['login_error'] = "Your password is wrong";

    }
  }else{
    $_SESSION['login_error'] = "Your email or roles is wrong or you does not verified account"; 

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
    <title>Login User</title>
  </head>
  <body  style="background-image: radial-gradient(circle farthest-corner at -3.1% -4.3%, rgba(57,255,186,1) 0%,rgba(21,38,32,1) 90%);color:white; overflow-x: hidden;">
 
     <div class="row" style="height: 100vh">
       <div class="col-md-6 m-auto">
         <div class="">
           <div class="card-header bg-info text-white text-center clearfix">
            <h5 class="float-left">User Login Form</h5>
            <a href="registration.php" class="btn btn-info float-right btn-sm"><i class="fa fa-plus"></i>  Registration</a>

          </div>

            <!-- show success message when user successfully verified -->
           <?php  if (isset($_SESSION['success'])): ?>

            <script type="text/javascript">
              Swal.fire({
                icon: 'success',
                html:'<p><b><i class="fa fa-success"></i></b><?php echo $_SESSION['success']; ?></p>',
              })
            </script>

           <?php endif; unset($_SESSION['success']); ?>



        
           <!-- show error message when user not verified or already verified -->
           <?php  if (isset($_SESSION['error'])): ?>

            <script type="text/javascript">
              Swal.fire({
                icon: 'success',
                html:'<p><b><i class="fa fa-warning"></i></b><?php echo $_SESSION['error']; ?></p>',
              })
            </script>

           <?php endif; unset($_SESSION['error']); ?>


           <!-- show login error message when user login does not successfull -->
           <?php  if (isset($_SESSION['login_error'])): ?>

            <script type="text/javascript">
              Swal.fire({
                icon: 'error',
                html:'<p><b><i class="fa fa-warning"></i></b><?php echo $_SESSION['login_error']; ?></p>',
              })
            </script>

           <?php endif; unset($_SESSION['login_error']); ?>

           <div class="text-white">
               <form action="" method="post">
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                      </div>
                      <input type="email" name="email" class="form-control" id="email"  placeholder="Enter email" value="<?php if(isset($_POST['email'])){echo $_POST['email']; } ?>">
                    </div> 
                  </div>

                  <div class="form-group">
                    <div class="clearfix">
                      <label for="password" class="float-left">Password</label>
                      <a href="forgot-password.php" class="float-right">Forgot password!</a>
                    </div>
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

                  <div class="form-group">
                    <label>Users Roles</label>
                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-male"></i></span>
                      </div>
                      <select class="form-control" name="role">
                        <option value="1">Admin</option>
                        <option value="2">Modaretor</option>
                        <option value="3">Editor</option>
                      </select>
                    </div>
                  </div>
                  <button type="submit" name="login" class="btn btn-success w-50">Login</button>
                </form>
           </div>
           <div class="card-footer text-center text-white mt-3">
            2020- <?php echo date('Y'); ?> &copy copyright Medu.com  All right reserved
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
      });
    </script>
  </body>
</html>
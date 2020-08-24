
<?php
session_start();

if (!isset($_SESSION['email'])) {
  header("location: forgot-password");
}

include 'includes/database.php';

$user_email = $_SESSION['email'];

if (isset($_POST['reset-password'])) {
  $new_password     = mysqli_real_escape_string($connect,trim($_POST['new-password']));
  $confirm_password = mysqli_real_escape_string($connect,trim($_POST['confirm-password']));

  if (empty($new_password)) {
    $_SESSION['error'] = "password must be required";
  }elseif (strlen($new_password) < 7 || strlen($new_password) > 32) {
    $_SESSION['error'] = "Password must be use between minimum 8 and maximum 32 character";

  }elseif (!preg_match('/[&,$,#,^,*]/', $new_password)) {
    $_SESSION['error'] = "Password use number , letter , and special character";

  }elseif ($new_password != $confirm_password) {
    $_SESSION['error'] = "password and confirm password does not match";

  }else{
    $password_hash = password_hash($new_password,PASSWORD_DEFAULT);
    $update_user = "UPDATE users SET password='$password_hash' WHERE email='$user_email'";
    $update_query = mysqli_query($connect,$update_user);
    if ($update_query) {
      $_SESSION['success'] = "Password reset has been successfully.now you can login";
      header("location: login.php");
      
    }else{
      $_SESSION['error'] = "Password does not reset.something went to wrong.please try again";
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
    <title>forgot password key verify page | medu</title>
  </head>
  <body  style="background-image: radial-gradient(circle farthest-corner at -3.1% -4.3%, rgba(57,255,186,1) 0%,rgba(21,38,32,1) 90%);color:white; overflow-x: hidden;">
 
     <div class="row" style="height: 100vh">
       <div class="col-md-6 m-auto">
         <div class="">
           <div class="card-header bg-info text-white text-center clearfix">
            <h5 class="text-center">Reset password for medu account</h5>
            

          </div>

          <?php  if (isset($_SESSION['success'])): ?>

            <script type="text/javascript">
              Swal.fire({
                icon: 'success',
                html:'<p><b><i class="fa fa-success"></i>&nbsp</b><?php echo $_SESSION['success']; ?></p>',
              })
            </script>

           <?php endif; unset($_SESSION['success']); ?>
        
           <!-- show error message when user not verified or already verified -->
           <?php  if (isset($_SESSION['error'])): ?>

            <script type="text/javascript">
              Swal.fire({
                icon: 'error',
                html:'<p><b><i class="fa fa-warning"></i>&nbsp</b><?php echo $_SESSION['error']; ?></p>',
              })
            </script>

           <?php endif; unset($_SESSION['error']); ?>

           <div class="text-white">
               <form action="" method="post">
                  <div class="form-group">
                    <label for="email">New Password</label>
                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                      </div>
                      <input type="password" name="new-password" class="form-control" id="npassword"  placeholder="New password" value="<?php if(isset($_POST['new-password'])){echo $_POST['new-password']; } ?>">
                      <div class="input-group-append">
                        <span class="input-group-text"><b id="click_icon_n" style="cursor: pointer;"><i id="nicon" class="fa fa-eye"></i></b></span>
                      </div>
                    </div> 
                  </div>

                  <div class="form-group">
                    <label for="password">Confirm password</label>
                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                      </div>
                      <input type="password" name="confirm-password" id="cpassword" placeholder="Confirm password" class="form-control" value="<?php if(isset($_POST['confirm-password'])){ echo $_POST['confirm-password']; } ?>">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><b id="click_icon_c" style="cursor: pointer;"><i id="cicon" class="fa fa-eye"></i></b></span>
                      </div>
                    </div>
                  </div>
                  <button type="submit" name="reset-password" class="btn btn-success w-50">Reset password</button>
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
        $("#click_icon_n").click(function(){
           $("#nicon").toggleClass("fa-eye-slash");
           $("#nicon").toggleClass("text-danger");
          var pass = $("#npassword");
          if (pass.attr("type") == "password") {
            pass.attr("type","text");
          }else{
            pass.attr("type","password");
          }
        });

        $("#click_icon_c").click(function(){
           $("#cicon").toggleClass("fa-eye-slash");
           $("#cicon").toggleClass("text-danger");
          var pass = $("#cpassword");
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
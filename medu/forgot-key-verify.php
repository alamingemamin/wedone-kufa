
<?php
session_start();
include 'includes/database.php';
if (isset($_POST['verify'])) {
  $email    = $_POST['email'];
  $fkey     = $_POST['forgot-key'];

  $email_sql   = "SELECT * FROM users WHERE email='$email' AND forgot_key='$fkey'";
  $email_query = mysqli_query($connect,$email_sql);
  $num_count   = mysqli_num_rows($email_query);
  if ($num_count != 0) {
    $user_row  = mysqli_fetch_assoc($email_query);
    $user_email = $user_row['email'];
      
      $_SESSION['email'] = $user_email;
      $_SESSION['success'] = "Your email and forgot password key is correct.now you can change your password for medu account";
      header("location: reset-password.php"); 

  }else{
    $_SESSION['error'] = "Your E-mail or fotgot password key code is wrong.please try again!!"; 

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
            <h5 class="text-center">Forgot password key varify  for medu account</h5>
            

          </div>
        
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
                    <label for="email">Email address</label>
                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                      </div>
                      <input type="email" name="email" class="form-control" id="email"  placeholder="Enter email" value="<?php if(isset($_POST['email'])){echo $_POST['email']; } ?>">
                    </div> 
                  </div>

                  <div class="form-group">
                    <label for="password">Forgot password key Code</label>
                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                      </div>
                      <input type="password" name="forgot-key" id="password" placeholder="Verification code" class="form-control" value="<?php if(isset($_POST['forgot-key'])){ echo $_POST['forgot-key']; } ?>">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><b id="click_icon" style="cursor: pointer;"><i id="icon" class="fa fa-eye"></i></b></span>
                      </div>
                    </div>
                  </div>
                  <button type="submit" name="verify" class="btn btn-success w-50">Save</button>
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
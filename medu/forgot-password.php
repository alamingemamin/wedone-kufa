
<?php
session_start();
include 'includes/database.php';
if (isset($_POST['forgot-password'])) {
  $email    = $_POST['email'];

  $email_sql   = "SELECT * FROM users WHERE email='$email'";
  $email_query = mysqli_query($connect,$email_sql);
  $num_count   = mysqli_num_rows($email_query);
  if ($num_count != 0) {
    $user_row  = mysqli_fetch_assoc($email_query);
    $user_forgot_key = base64_encode(rand(1,99999999));
    $user_id   = $user_row['id'];

    $user_update = "UPDATE users SET forgot_key='$user_forgot_key' WHERE id='$user_id'";
    $update_query = mysqli_query($connect,$user_update);

    $to = $email;
    $subject = "Password fotgot key for medu account";
    $message = "<a href='http://localhost/medu/forgot-key-verify.php'>Forgot password key</a><br><p>Password fotgot key code: $user_forgot_key</p>";
    $headers  = "From: alamingemamin@gmail.com \r\n";
    $headers .= "MIME-Version: 1.0"."\r\n";
    $headers .= "Content-type: text/html;charset=UTF-8"."\r\n";

    if (mail($to,$subject,$message,$headers)) {
      if ($update_query) {
        $_SESSION['success'] = "Your email is correct for medu account.now check your email and try to forgot password";

      }else{
        $_SESSION['error'] = "Something went wrong!!!";
      
     }
    }else{
      $_SESSION['error'] = "mail does not send";
    }
    
  }else{
    $_SESSION['error'] = "Your E-mail is wrong.!!"; 

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
    <title>Forgot password page | medu</title>
  </head>
  <body  style="background-image: radial-gradient(circle farthest-corner at -3.1% -4.3%, rgba(57,255,186,1) 0%,rgba(21,38,32,1) 90%);color:white; overflow-x: hidden;">
 
     <div class="row" style="height: 100vh">
       <div class="col-md-6 m-auto">
         <div class="">
           <div class="card-header bg-info text-white text-center clearfix">
            <h5 class="text-center">Forgot Password medu account</h5>
          </div>
         <p class="text-center">
              To reset your password, enter the registred email address and we will send you reset instructions on your email
            </p>

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
                    <label for="email">Email address</label>
                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-at"></i></span>
                      </div>
                      <input type="email" name="email" class="form-control" id="email"  placeholder="Enter email" value="<?php if(isset($_POST['email'])){echo $_POST['email']; } ?>">
                    </div> 
                  </div>
                  <button type="submit" name="forgot-password" class="btn btn-success w-50">Forgot password</button>
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
  </body>
</html>
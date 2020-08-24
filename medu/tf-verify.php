
<?php
session_start();
include 'includes/database.php';
if (isset($_POST['verify'])) {
  $email    = $_POST['email'];
  $tfkey     = $_POST['tfkey'];

  $email_sql   = "SELECT * FROM users WHERE email='$email' AND tf_key='$tfkey'";
  $email_query = mysqli_query($connect,$email_sql);
  $num_count   = mysqli_num_rows($email_query);
  if ($num_count != 0) {
    $row  = mysqli_fetch_assoc($email_query);
  
      $_SESSION['login_success'] = "Congratulations,Login has been successfully.";
      $_SESSION['user_id']       = $row['id'];
      $_SESSION['user_name']     = $row['name'];
      $_SESSION['user_email']    = $row['email'];
      $_SESSION['user_password'] = $row['password'];
      $_SESSION['user_role']     = $row['role'];
      $_SESSION['user_photo']    = $row['user_photo'];

      setcookie("username",$row['name'],time()+86400);
      header("location: dashboard/auth/index.php");
  }else{
    $_SESSION['error'] = "Varification code is wrong.please try again!!"; 

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
    <title>Email verification page | medu</title>
  </head>
  <body  style="background-image: radial-gradient(circle farthest-corner at -3.1% -4.3%, rgba(57,255,186,1) 0%,rgba(21,38,32,1) 90%);color:white; overflow-x: hidden;">
 
     <div class="row" style="height: 100vh">
       <div class="col-md-6 m-auto">
         <div class="">
           <div class="card-header bg-info text-white text-center clearfix">
            <h5 class="text-center">Enter Two factor Verification code for medu account</h5>
            

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
                  
                  <input type="hidden" name="email"  value="<?php if(isset($_SESSION['user_email'])){echo $_SESSION['user_email']; } ?>">
              

                  <div class="form-group">
                    <label for="password">Verification Code</label>
                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                      </div>
                      <input type="password" name="tfkey" id="password" placeholder="Verification code" class="form-control" value="<?php if(isset($_POST['tfkey'])){ echo $_POST['tfkey']; } ?>">
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
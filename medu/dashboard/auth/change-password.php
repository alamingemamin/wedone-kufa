<?php 
session_start();

require_once "../auth_check.php";

require_once "../../includes/database.php";


if (isset($_POST['change-password'])) {
	$email             = mysqli_real_escape_string($connect,trim($_POST['email']));
	$old_password      = mysqli_real_escape_string($connect,trim($_POST['old-password']));
	$new_password      = mysqli_real_escape_string($connect,trim($_POST['new-password']));
	$confirm_password  = mysqli_real_escape_string($connect,trim($_POST['confirm-password']));

	if (empty($new_password)) {
		$_SESSION['error']  = "Your new password is required";
 	}elseif (strlen($new_password) < 7 || strlen($new_password) > 32) {
      $_SESSION['error'] = " new Password must be use between minimum 8 and maximum 32 character";

    }elseif (!preg_match('/[&,$,#,^,*]/', $new_password)) {
      $_SESSION['error'] = "new Password use number , letter , and special character";

    }elseif ($new_password != $confirm_password) {
      $_SESSION['error'] = "new Password and Confirm Password Does not match";

    }else{
      $select_email = "SELECT * FROM users WHERE email='$email'";
	  $email_query  = mysqli_query($connect,$select_email);

		if (mysqli_num_rows($email_query) != 0) {
			$user_row       = mysqli_fetch_assoc($email_query);
			$user_password  = $user_row['password'];

			if (password_verify($old_password,$user_password)) {
				$password_hash = password_hash($new_password,PASSWORD_DEFAULT);
				$update_password = "UPDATE users SET email='$email', password='$password_hash' WHERE email='$email'";

				$update_query = mysqli_query($connect,$update_password);

				if ($update_query) {
					$_SESSION['success'] = "Password change has been successfully.next time login your new password.";
					header("location: index.php");

				}else{
					$_SESSION['error'] = "password does not change.something is wrong!!";

				}
			}else{
				$_SESSION['error'] = "Your Old password is wrong";

			}
		}else{
			$_SESSION['error'] = "Your Email is Wrong";

		}
    }

	

}

$title = "Change password";

 ?>


 <?php include "../../includes/layouts/header.php";?>
 
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8 m-auto">


            <?php  if (isset($_SESSION['error'])): ?>


            <script type="text/javascript">
              Swal.fire({
                icon: 'error',
                html:'<p><b class="text-danger"><i class="fa fa-warning"></i></b>&nbsp&nbsp&nbsp<span class="text-warning"><?php echo $_SESSION['error']; ?></span></p>',
              })
            </script>

           <?php endif; unset($_SESSION['error']); ?>



				<div class="text-white">

					<form action="" method="post">
					
							
								<input type="text" name="email" hidden="" class="form-control" value="<?= $_SESSION['user_email']; ?>">
						

						<div class="form-group">
							<label class="text-white">Old Password</label>
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input type="password" name="old-password" id="password" class="form-control" value="<?php if(isset($_POST['old-password'])){echo $_POST['old-password']; } ?>" placeholder="Old Password">
								<div class="input-group-prepend">
			                        <span class="input-group-text"><b id="click_icon" style="cursor: pointer;"><i id="icon" class="fa fa-eye"></i></b></span>
			                    </div>
							</div>
						</div>

						<div class="form-group">
							<label class="text-white">New password</label>
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text"><i  class="fas fa-key"></i></span>
								</div>
								<input type="password" name="new-password" id="npassword" class="form-control" value="<?php if(isset($_POST['new-password'])){echo $_POST['new-password']; } ?>" placeholder="New Password">
								<div class="input-group-prepend">
			                        <span class="input-group-text"><b id="nclick_icon" style="cursor: pointer;"><i id="nicon" class="fa fa-eye"></i></b></span>
			                    </div>
							</div>
						</div>


						<div class="form-group">
							<label class="text-white">Confirm password</label>
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input type="password" name="confirm-password" id="cpassword" class="form-control" value="<?php if(isset($_POST['confirm-password'])){echo $_POST['confirm-password']; } ?>" placeholder="confirm password">
								<div class="input-group-prepend">
			                        <span class="input-group-text"><b id="click_icon_c" style="cursor: pointer;"><i id="cicon" class="fa fa-eye"></i></b></span>
			                    </div>
							</div>
						</div>

						<div class="form-group">
							<input type="submit" name="change-password" value="Change Password" class="btn btn-pink">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



 <?php include "../../includes/layouts/footer.php";?>
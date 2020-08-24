<?php 

session_start();
include "../auth_check.php";

include "../../includes/database.php";

$select_setting = "SELECT * FROM settings LIMIT 1";
$select_query   = mysqli_query($connect,$select_setting);
$setting_row    = mysqli_fetch_assoc($select_query);

if (isset($_POST['save'])) {
	if (!isset($_POST['rpermission'])) {
        $_SESSION['error'] = "Role permission select minimum one item";

	}else{
		 $role_permissions = $_POST['rpermission'];
		 $role_im = implode('.',$role_permissions);
		 $psort   = $_POST['psort'];
		 $pfilter = $_POST['pfilter'];
		 $limit   = $_POST['limit'];

		 if ($tfv == 1) {
		 	$_SESSION['success']  = "Value is one";
		 }else{
            $_SESSION['error']    = "value is zero";
		 }

		 $update_setting = "UPDATE settings SET register_role='$role_im',limitation='$limit',sorting='$psort',filtering='$pfilter' WHERE id='1'"; 

		 $setting_query  = mysqli_query($connect,$update_setting);

		 if ($setting_query) {
		    $_SESSION['success'] = "Setting Save successfully";
		    header("location: setting.php");
		 }else{
		 	$_SESSION['error']   = "Something went to wrong!!";
		 }		
    }
					
}



if (isset($_POST['update'])) {
	$user_email = $_SESSION['user_email'];
	$tf_email   = $_POST['tf_email'];
	$tfv        = $_POST['tfv'];

	if ($tfv==1) {
		if (empty($tf_email)) {
			$_SESSION['error'] = "two facter recevied email must be required";
		}else{
		 $update_user = "UPDATE users SET tf_email='$tf_email' WHERE email='$user_email'";
		 $update_user_query = mysqli_query($connect,$update_user);
		 if ($update_user_query) {
		 	$update_tfv = "UPDATE settings SET tf_auth='$tfv' WHERE id='1'";
		 	$update_tfv_query = mysqli_query($connect,$update_tfv);
		 	if ($update_tfv_query) {
		 		header("location: setting.php");
		 		$_SESSION['success'] = "Two factor authentication turn on succcessfully";
		 	}else{
		 		$_SESSION['error']  = "Opss!!,something went wrong.please try again";
		 	}
		 }else{
		 	$_SESSION['error'] = "Oppss!!,something went to wrong please try again";
		 }

		}
	}else{
		$update_tfv = "UPDATE settings SET tf_auth='$tfv' WHERE id='1'";
		$update_tfv_query = mysqli_query($connect,$update_tfv);
	 	if ($update_tfv_query) {
	 		header("location: setting.php");
	 		$_SESSION['success'] = "Two factor authentication turn off succcessfully";
	 	}else{
	 		$_SESSION['error']  = "Opss!!,something went wrong.please try again";
	 	}
	}

	
}

$title = "Setting page";
 ?>

 <?php 

include "../../includes/layouts/header.php";


 ?>

 <div class="content">
 	<div class="container-fluid">
 		<div class="row">
 			<div class="col-lg-6">
 				<div class="card-header text-center mb-2" style="background: #112233;">
 					Setting All of others
 				</div>

 				<?php if(isset($_SESSION['success'])): ?>
                        <script type="text/javascript">
                          Swal.fire({
                            icon: 'success',
                            html:'<p><b class="text-success"><i class="fa fa-ok"></i></b>&nbsp&nbsp&nbsp<span class="text-success"><?php echo $_SESSION['success']; ?></span></p>',
                          })
                        </script>

                <?php endif; unset($_SESSION['success']); ?>

                <?php if(isset($_SESSION['error'])): ?>
                    <script type="text/javascript">
                      Swal.fire({
                        icon: 'error',
                        html:'<p><b class="text-danger"><i class="fa fa-ok"></i></b>&nbsp&nbsp&nbsp<span class="text-danger"><?php echo $_SESSION['error']; ?></span></p>',
                      })
                    </script>

                <?php endif; unset($_SESSION['error']);  ?>
 				<form action="" method="post">
 				   

 				   <table class="table">
 				   	<tr>
 				   		<th>Registration Role Permission<br>
 				   			<small class="muted">Who registration of your website</small>
 				   		</th>
 				   		<td>
 				   			<div class="form-check form-check-inline">
							  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" name="rpermission[]" <?php if($setting_row['register_role'] == '1' || $setting_row['register_role'] == '1.2' || $setting_row['register_role'] == '1.3'){ echo "checked"; } ?> >
							  <label class="form-check-label text-success" for="inlineCheckbox1">Admin</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="2" name="rpermission[]" <?php if($setting_row['register_role'] == '2' || $setting_row['register_role'] == '1.2' || $setting_row['register_role'] == '2.3'){ echo "checked"; } ?>>
							  <label class="form-check-label text-success" for="inlineCheckbox2">Modarator</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="3" name="rpermission[]" <?php if($setting_row['register_role'] == 3 || $setting_row['register_role'] == 1.3 || $setting_row['register_role'] == 2.3){ echo "checked"; } ?>>
							  <label class="form-check-label text-success" for="inlineCheckbox3">Editor</label>
							</div>
 				   		</td>
 				   	</tr>

 				   	<tr>
 				   		<th>
 				   			<label class="text-white">Post Sorting : </label>
 				   		</th>
 				   		<td>
	 				   		<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="psort" id="inlineRadio1" value="DESC" <?php if($setting_row['sorting'] == 'DESC'){ echo "checked"; } ?> >
							  <label class="form-check-label text-primary" for="inlineRadio1">DESC</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="psort" id="inlineRadio2" value="ASC" <?php if($setting_row['sorting'] == 'ASC'){ echo "checked"; } ?>>
							  <label class="form-check-label text-warning" for="inlineRadio2">ASC</label>
							</div>
 				   		</td>
 				   	</tr>

 				   	<tr>
 				   		<th>
 				   			<label class="text-white">Post Filtering : </label>
 				   		</th>
 				   		<td>
	 				   		<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="pfilter" id="inlineRadio1" value="id" <?php if($setting_row['filtering'] == 'id'){ echo "checked"; } ?>  >
							  <label class="form-check-label text-primary" for="inlineRadio1">Id</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="pfilter" id="inlineRadio2" value="title" <?php if($setting_row['filtering'] == 'title'){ echo "checked"; } ?>>
							  <label class="form-check-label text-warning" for="inlineRadio2">Title</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="pfilter" id="inlineRadio2" value="body" <?php if($setting_row['filtering'] == 'body'){ echo "checked"; } ?>>
							  <label class="form-check-label text-warning" for="inlineRadio2">Body</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="pfilter" id="inlineRadio2" value="created_at" <?php if($setting_row['filtering'] == 'created_at'){ echo "checked"; } ?>>
							  <label class="form-check-label text-warning" for="inlineRadio2">Date</label>
							</div>
 				   		</td>
 				   	</tr>




 				   	<tr>
 				   		<th>Post Per Page Limitation</th>
 				   		<td>
 				   			<select class="form-control" name="limit">
 				   			<?php for($i=1;$i<=10;$i++) { ?>
 				   				<option value="<?= $i;?>" <?php if ($setting_row['limitation'] == $i){ echo "selected"; } {
 				   					# code...
 				   				} ?>> <?= $i;?> </option>
 				   			<?php }?>
 				   			</select>
 				   		</td>
 				   	</tr>

 				   	
 				   </table>

 				   <tr>
 				   	 
 				   	 	<input type="submit" name="save" class="btn btn-sm btn-pink w-25" value="Save">
 				   	 
 				   </tr>
 				</form>
 			</div>



 			<div class="col-lg-6">
 				<div class="card-header text-center mb-2" style="background: #112233;">
 					Option two factor authentication setting
 				</div>
 				<form action="" method="post">
 				   

 				   <table class="table">
 				   	<tr>
 				   		<th>
		 				   <label class="text-white">Choose Two fector Authentication : </label>
 				   		</th>
 				   		<td>
	 				   		<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="tfv" id="tfvon" value="1" <?php if($setting_row['tf_auth'] == 1){ echo "checked"; } ?> >
							  <label class="form-check-label text-primary" for="inlineRadio1">ON</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="tfv" id="inlineRadio2" value="0" <?php if($setting_row['tf_auth'] == 0){ echo "checked"; } ?>>
							  <label class="form-check-label text-warning" for="inlineRadio2">OFF</label>
							</div>	
 				   		</td>
 				   	</tr>

 				   	<tr>
 				   		
	 				   <input type="email" id="tfvemail" name="tf_email" class="form-control" placeholder="Enter email where we will send verification code" style="display: none;">
 				   	</tr>
			   	
 				   </table>

 				   <tr>
 				   	 
 				   	 	<input type="submit" name="update" class="btn btn-sm btn-pink w-25 float-right" value="Save">
 				   	 
 				   </tr>
 				</form>
 			</div>
 		</div>
 	</div>
 </div>


 <?php 

include "../../includes/layouts/footer.php";

  ?>
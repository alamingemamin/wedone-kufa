<?php 
session_start();
require_once '../auth_check.php';
require_once '../../includes/database.php';

$email = $_SESSION['user_email'];

$select_user = "SELECT * FROM users WHERE email='$email'";
$user_query  = mysqli_query($connect,$select_user);

if (mysqli_num_rows($user_query) != 0) {
	$user_row = mysqli_fetch_assoc($user_query);
}
$title = "My account";

include '../../includes/layouts/header.php';

?>


<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8 m-auto">
				<div class="text-white">
					<table class="table">
						<tr>
							<th class="text-pink">Full Name</th>
							<td><?= $user_row['name']; ?></td>
						</tr>
						<tr>
							<th class="text-pink">Gender</th>
							<td><?= $user_row['gender']; ?></td>
						</tr>
						<tr>
							<th class="text-pink">Email</th>
							<td><?= $user_row['email']; ?></td>
						</tr>
						<tr>
							<th class="text-pink">Role</th>
							<td>
								<?php if ($user_row['role'] == 1){ ?>
									Admin
								<?php }elseif($user_row['role'] == 2){ ?>
                                    Motivator
								<?php }elseif($user_row['role'] == 3){ ?>
									Editor
								<?php }else{ ?>
									Normal
								<?php } ?>
							</td>
						</tr>
						<tr>
							<th class="text-pink">Created Date</th>
							<td><?= $user_row['created_at']; ?></td>
						</tr>

						<tr>
							<th class="text-pink">Photo</th>
							<td><img src="../../uploads/users-photos/<?= $user_row['user_photo']; ?>" class="img-fluid card-img"></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



<?php
include '../../includes/layouts/footer.php';

 ?>
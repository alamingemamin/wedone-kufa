<?php 
session_start();
require_once "../auth_check.php";
require_once "../../includes/database.php";

$select_post = "SELECT * FROM posts WHERE deleted='1' ORDER BY id DESC";
$post_query  = mysqli_query($connect,$select_post);









$title = "Blog post trash list | medu";
include "../../includes/layouts/header.php";

?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				 <!-- show success message when user successfully verified -->
          
               <div class="card-box clearfix">
               	 <h5 class="float-left">Trash post list</h5>
               	 <a href="post-list.php" class="btn btn-sm btn-custom float-right" data-toggle="modal" data-target="#exampleModalAdd">Post list</a>
               </div>

				<div class="text-white">
					<table class="table table-bordered table-hover table-striped" id="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Photo</th>
								<th>Title</th>
								<th>Body</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; while ($post_row    = mysqli_fetch_assoc($post_query)) { ?>
							
							<tr>
								<td><?= $i++;?></td>
								<td><img src="../../uploads/post-photos/<?= $post_row['photo']; ?>" class="rounded" style="height: 40px;width: 80px;"></td>

								<td><?= $post_row['title']; ?></td>
								<td>
									<?= substr($post_row['body'], 0,20)."...more click to view"?>
								</td>
								<td>
									<?php
                                     if ($post_row['status'] == 1) { ?>
                                        <a href="post-deactive.php?id=<?= $post_row['id']?>" class="btn" title="active"><i class="fas fa-toggle-on" style="font-size: 28px;"></i></a>
                                     <?php }else { ?>
                                       <a href="post-active.php?id=<?= $post_row['id']?>" class="btn text-white" title="deactive"><i class="fas fa-toggle-off" style="font-size: 28px;"></i></a>
                                     <?php  } 
                                    ?>
								</td>
								<td>
									<?php if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 3) { ?>

                                        <a href="view.php?id=<?php echo $post_row['id'];?>&file_name=<?= $post_row['photo'];?>" class="btn text-purple"><i class="fa fa-eye"></i>
                                        </a>
                                    <?php } ?>

									<?php if ($_SESSION['user_role'] == 1) { ?>


									<a href="restore.php?id=<?= $post_row['id'];?>" class="btn text-info" onclick="return confirm('are you sure restore this post?')">Restore</a>

									<a href="delete.php?id=<?= $post_row['id'];?>&file_name=<?= $post_row['photo']?>" class="btn text-danger" onclick="return confirm('are you sure permanently deleted this post?')"><i class="fas fa-trash"></i></a>
										
									<?php } ?>
								</td>
							</tr>
							<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th>#</th>
								<th>Photo</th>
								<th>Title</th>
								<th>Body</th>
								<th>User</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



<?php
include "../../includes/layouts/footer.php";


 ?>
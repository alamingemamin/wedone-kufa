<?php 
session_start();
require_once "../auth_check.php";
require_once "../../includes/database.php";

$select_post = "SELECT * FROM posts WHERE deleted='0' ORDER BY id DESC";
$post_query  = mysqli_query($connect,$select_post);



if (isset($_POST['add-post'])) {
	$title       = mysqli_real_escape_string($connect,trim($_POST['title']));
	$body        = mysqli_real_escape_string($connect,trim($_POST['body']));
	$user_id     = $_POST['user_id'];
	$post_photo  = $_FILES['post-photo'];


	if (empty($title)) {
	    $_SESSION['error'] = "Title must be required";

	}elseif (empty($body)) {
		$_SESSION['error'] = "Body must be required";

	}else{
		if ($post_photo['name'] != null) {
			$explode   = explode('.',$post_photo['name']);
			$extension = strtolower(end($explode));
			$allowed   = array('png','jpg','jpeg');
			if (!in_array($extension, $allowed)) {
				$_SESSION['error'] = "photo must be use png or ico type";

			}elseif ($post_photo['size'] > (1024*1024*2)) {
				$_SESSION['error'] = "Photo size too large!!.use maximum 1mb not more then";

			}else{
				$insert_post = "INSERT INTO posts(user,title,body) VALUES('$user_id','$title','$body')";
				$insert_query = mysqli_query($connect,$insert_post);
				if ($insert_query) {
					$last_id = mysqli_insert_id($connect);
					$post_photo_name = $last_id.'.'.$extension;
	                $destination    = '../../uploads/post-photos/'.$post_photo_name;
            
	                if (move_uploaded_file($post_photo['tmp_name'],$destination)) {
	                	$update_sql = "UPDATE posts SET photo='$post_photo_name' WHERE id='$last_id'";
	                	$update_result = mysqli_query($connect,$update_sql);

	                	if ($update_result) {
	                		$_SESSION['success'] = "Blog post uploaded successfully";
	                	    header("location: post-list.php");		
	                	
	                	}else{
	                		$_SESSION['error'] = "Blog post does not uploaded";	
	                	}
	                }else{
	                	$_SESSION['error'] = "photo does not upload.try to again!!";
	                }
				}else{
                   $_SESSION['error'] = "post data does not inserted";
				}
				
			}
		}else{
			$insert_post = "INSERT INTO posts(user,title,body) VALUES('$user_id','$title','$body')";
		    $insert_query = mysqli_query($connect,$insert_post);

			if ($insert_query) {
				$_SESSION['success'] = "blog post uploaded has been successfully";
				header("location: post-list.php");
			}else{
				$_SESSION['error'] = "Something went to wrong";
			}
		}
	}
}








if (isset($_POST['update-post'])) {
	$update_id     = $_POST['id'];
	$update_title  = mysqli_real_escape_string($connect,trim($_POST['title']));
	$update_body   = mysqli_real_escape_string($connect,trim($_POST['body']));
	$update_user_id     = $_POST['user_id'];
	$update_post_photo  = $_FILES['post-photos'];


	if (empty($update_title)) {
	    $_SESSION['error'] = "Title must be required";

	}elseif (empty($update_body)) {
		$_SESSION['error'] = "Body must be required";

	}else{
		if ($update_post_photo['name'] != null) {
			$update_explode   = explode('.',$update_post_photo['name']);
			$update_extension = strtolower(end($update_explode));
			$update_allowed   = array('png','jpg','jpeg');
			if (!in_array($update_extension, $update_allowed)) {
				$_SESSION['error'] = "photo must be use png or ico type";
			}elseif ($update_post_photo['size'] > (1024*1024*2)) {
				$_SESSION['error'] = "Photo size too large!!.use maximum 1mb not more then";
			}else{
				$update_post_photo_name = $update_id.'.'.$extension;
                $update_destination    = '../../uploads/post-photos/'.$update_post_photo_name;
                if (file_exists($update_destination)) {
                	if (unlink($update_destination)) {
                	   if (move_uploaded_file($update_post_photo['tmp_name'],$update_destination)) {
		                	$update_sql = "UPDATE posts SET title='$update_title', body='$update_body', photo='$update_post_photo_name', user='$update_user_id' WHERE id='$update_id'";
		                	$update_result = mysqli_query($connect,$update_sql);

		                	if ($update_result) {
		                		$_SESSION['success'] = "Blog post updated successfully";
	                	        header("location: post-list.php");
		                	
		                	}else{
		                		$_SESSION['error'] = "Blog post does not updated";	
		                	}
		                }else{
		                	$_SESSION['error'] = "Photo  does not upload.try to again!!";
		                }

                	}else{
                        $_SESSION['error'] = "existing photo does not delelted";
                	}
                }else{
	                if (move_uploaded_file($update_post_photo['tmp_name'],$update_destination)) {
	                	$update_sql = "UPDATE posts SET title='$update_title', body='$update_body', photo='$update_post_photo_name', user='$update_user_id' WHERE id='$update_id'";
	                	$update_result = mysqli_query($connect,$update_sql);

	                	if ($update_result) {
	                		$_SESSION['success'] = "Blog post updated successfully";
	                	    header("location: post-list.php");
	                	}else{
	                		$_SESSION['error'] = "Blog post does not uploaded";	
	                	}
	                }else{
	                	$_SESSION['error'] = "photo does not upload.try to again!!";
	                }

                }
			}
		}else{
			$update_post    = "UPDATE posts SET title='$update_title', body='$update_body', user='$update_user_id' WHERE id='$update_id'";
			$update_post_query =  mysqli_query($connect,$update_post);

			if ($update_post_query) {
				$_SESSION['success'] = "blog post update has been successfully";
				header("location: post-list.php");
			}else{
				$_SESSION['error'] = "Something went to wrong";
			}
		}
	}
}



$title = "Blog post list | medu";
include "../../includes/layouts/header.php";

?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				 <!-- show success message when user successfully verified -->
           <?php if(isset($_SESSION['success'])): ?>

            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-left: 5px solid #0acf70; border-radius: 4px 0px 0px 4px;">
              <strong><?= $_SESSION['success']; ?></strong> 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>                                           
                

        	<?php endif; unset($_SESSION['success']);  ?>



        
           <!-- show error message when user not verified or already verified -->
           <?php  if (isset($_SESSION['error'])): ?>

            <script type="text/javascript">
              Swal.fire({
                icon: 'error',
                html:'<p><b><i class="fa fa-warning"></i></b><?php echo $_SESSION['error']; ?></p>',
              })
            </script>

           <?php endif; unset($_SESSION['error']); ?>

               <div class="card-box clearfix">
               	 <h5 class="float-left">Blog post list</h5>
               	 <a href="" class="btn btn-sm btn-custom float-right" data-toggle="modal" data-target="#exampleModalAdd">Add New Blog Post</a>
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

									<!-- Button trigger modal -->
									<a class="btn text-custom" data-toggle="modal" data-target="#exampleModaledit<?= $post_row['id'];?>">
									 <i class="fas fa-edit"></i> 
									</a>

									<!-- Modal -->
									<div class="modal fade" id="exampleModaledit<?= $post_row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									  <div class="modal-dialog modal-dialog-centered" role="document">
									    <div class="modal-content">
									      <div class="modal-header" style="background: #112233;">
									        <h5 class="modal-title" id="exampleModalLongTitle">Update Blog post</h5>
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
									      </div>
									      <div class="modal-body text-center" style="background: #112233;">
									      	<img src="../../uploads/post-photos/<?= $post_row['photo']; ?>" style="height: 200px;width: 460px;" class="mb-2">
									        <form action="" method="post" enctype="multipart/form-data">
									        	 <input type="hidden" name="id" value="<?= $post_row['id'];?>">
									        	 <div class="form-group">
									        	 	<label class="float-left text-purple">Title : </label>
									        	 	<div class="input-group">
									        	 		<div class="input-group-append">
									        	 			<span class="input-group-text"><i class="fas fa-heart"></i></span>
									        	 		</div>
									        	 		<input type="text" name="title" class="form-control" value="<?= $post_row['title'] ?>">
									        	 	</div>
									        	 </div>


									        	 <div class="form-group">
									        	 	
									        	 	<div class="input-group">
									    
									        	 		<input type="hidden" name="user_id" class="form-control" value="<?= $post_row['user'] ?>">
									        	 	</div>
									        	 </div>


									        	 <div class="form-group">
									        	 	<label class="float-left text-purple">Photo : </label>
									        	 	<div class="input-group">
									        	 		<div class="input-group-append">
									        	 			<span class="input-group-text"><i class="fas fa-images"></i></span>
									        	 		</div>
									        	 		<input type="file" name="post-photos" class="form-control form-control-file" value="<?= $post_row['photo'] ?>">
									        	 	</div>
									        	 </div>


									        	 <div class="form-group">
									        		<label class="text-white">Body : </label>
									        		<div class="input-group">
									        			<div class="input-group-append">
									        				<span class="input-group-text"><i class="fas fa-heart"></i></span>
									        			</div>
									        			<textarea name="body" cols="5" rows="5" class="form-control"><?= $post_row['body'];?></textarea>
									        		</div>
									        	</div>

									        	 <div class="form-group">
									        	 	<input type="submit" name="update-post" class="btn btn-pink" value="Published">
									        	 </div>
									        </form>
									      </div>
									      <div class="modal-footer" style="background: #112233;">
									        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									      </div>
									    </div>
									  </div>
									</div>

									<a href="trash.php?id=<?= $post_row['id'];?>" class="btn text-danger" onclick="return confirm('are you sure move to trash this post?')">Trash</a>

									<a href="delete.php?id=<?= $post_row['id'];?>&file_name=<?= $post_row['photo'];?>" class="btn text-danger" onclick="return confirm('are you sure permanently deleted this post?')"><i class="fas fa-trash"></i></a>
										
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



<!-- Modal -->
<div class="modal fade" id="exampleModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#112233;">
        <h5 class="modal-title" id="exampleModalLongTitle">Add new blog post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="background:#112233;">
        <form action="" method="post" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-6">
        			<div class="form-group">
        				<label class="text-white">User : </label>
		        		<div class="input-group">
		        			<div class="input-group-append">
		        				<span class="input-group-text"><i class="fas fa-user"></i></span>
		        			</div>

		        			<select name="user_id" class="form-control">
		        				<option value="<?= $_SESSION['user_name']; ?>"><?= $_SESSION['user_name']; ?></option>
		        			</select>
		        		</div>
		        	</div>
        		</div>

        		<div class="col-6">
        			<div class="form-group">
        				<label class="text-white">Photo : </label>
		        		<div class="input-group">
		        			<div class="input-group-append">
		        				<span class="input-group-text"><i class="fas fa-images"></i></span>
		        			</div>
		        			<input type="file" name="post-photo" class="form-control form-control-file" />
		        		</div>
		        	</div>
        		</div>
        	</div>
        	
            <div class="form-group">
            	<label class="text-white">Post Title :</label>
        		<div class="input-group">
        			<div class="input-group-append">
        				<span class="input-group-text"><i class="fas fa-heart"></i></span>
        			</div>
        			<input type="text" name="title" class="form-control" placeholder="Post title" value="<?php if(isset($_POST['title'])){echo $_POST['title']; } ?>">
        		</div>
        	</div>
        	

        	<div class="form-group">
        		<label class="text-white">Post Body : </label>
        		<div class="input-group">
        			<div class="input-group-append">
        				<span class="input-group-text"><i class="fas fa-heart"></i></span>
        			</div>
        			<textarea name="body" cols="5" rows="5" class="form-control"><?php if (isset($_POST['body'])) {echo $_POST['body'];}?></textarea>
        		</div>
        	</div>


        	<div class="form-group">
        		<input type="submit" name="add-post" class="btn btn-pink btn-sm" value="Upload New Blog Post">
        	</div>
        </form>
      </div>
      <div class="modal-footer" style="background:#112233;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
include "../../includes/layouts/footer.php";


 ?>
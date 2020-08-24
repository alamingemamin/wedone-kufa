<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";
 
  // add new photos into photos table
  if (isset($_POST['add-photo'])) {
    $banner_id     = $_POST['banner_id'];
    $photo         = $_FILES['photo'];
    $expolde_photo = explode('.',$photo['name']);
    $extension     = strtolower(end($expolde_photo));
    $allowed       = array('png','jpg','jpeg','gif');
    if ($photo['name'] == null) {
      $_SESSION['error'] = "File does not found!!";

    }elseif (!in_array($extension,$allowed)) {
      $_SESSION['error'] = "FIle format must be use png type!!!";

    }elseif ($photo['size'] > (1024*1024)) {
      $_SESSION['error'] = "FIle size is too large!!!";

    }else{
      $insert_photo  = "INSERT INTO photos(banner_id) VALUES('$banner_id')";
      $insert_query = mysqli_query($connect,$insert_photo);

      if ($insert_query) {
         $last_id     = mysqli_insert_id($connect);
         $photo_name  = $last_id.'.'.$extension;
         $destination = '../../uploads/photos/'.$photo_name;

         if (move_uploaded_file($photo['tmp_name'],$destination)) {
           $update_photo_new  = "UPDATE photos SET photo='$photo_name' WHERE id='$last_id'";
           $update_query_new = mysqli_query($connect,$update_photo_new);

           if ($update_query_new) {
             $_SESSION['success'] = "photo uploaded has been successfully";

           }else{
            $_SESSION['error']    = "Opps!!!, something went to wrong.please try again";

           }
         }else{
          $_SESSION['error'] = "FIle does not upload!!!";

         }
      }else{
        $_SESSION['error'] = "File does not insert into database";

      }
    }
  }

 
    // update photo into photos table
    if (isset($_POST['update-photo'])) {
    $update_photo         = $_FILES['photo'];
    $update_id            = $_POST['id'];
    $edit_photo           = $_POST['edit_photo'];
    $update_banner_id     = $_POST['banner_id'];
    $update_expolde_photo = explode('.',$update_photo['name']);
    $update_extension     = strtolower(end($update_expolde_photo));
    $update_allowed       = array('png','jpg','jpeg','gif');

    if ($update_photo['name'] == null) {
      $_SESSION['error'] = "update File does not found!!";

    }elseif (!in_array($update_extension,$update_allowed)) {
      $_SESSION['error'] = "update FIle format must be use png type!!!";

    }elseif ($update_photo['size'] > (1024*1024)) {
      $_SESSION['error'] = "update FIle size is too large!!!";

    }else{
         if (unlink('../../uploads/photos/'.$edit_photo)) {
            $update_photo_name = $update_id.'.'.$update_extension;
            $update_destination = '../../uploads/photos/'.$update_photo_name;
           if (move_uploaded_file($update_photo['tmp_name'],$update_destination)) {
             $update_photo_sql   = "UPDATE photos SET photo='$update_photo_name', banner_id='$update_banner_id' WHERE id='$update_id'";
             $update_photo_query = mysqli_query($connect,$update_photo_sql);

             if ($update_photo_query) {
               $_SESSION['success'] = "photo has been updated successfully";

             }else{
              $_SESSION['error'] = "OPSSS!!!,photo does not updated";
             }

           }else{
            $_SESSION['error'] = "Update file does not upload!!";

           }
         }else{
          $_SESSION['error'] = "old photo does not delete!!!";

         }
         

     
    }
  }

  $sql   = "SELECT * FROM photos WHERE deleted='0' ORDER BY id DESC";
  $query = mysqli_query($connect,$sql);

$title = "All photos list page";
?>
<?php require "../../includes/layouts/header.php"; ?>

      <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-9 text-white">
                                
                                   
                                    	
                                    	<?php if(isset($_SESSION['success'])): ?>

                                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-left: 5px solid #0acf70; border-radius: 4px 0px 0px 4px;">
                                          <strong><?= $_SESSION['success']; ?></strong> 
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>                                           

                                    	<?php endif; unset($_SESSION['success']);  ?>


                                      <?php if(isset($_SESSION['error'])): ?>

                                        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="border-left: 5px solid #ff0000; border-radius: 4px 0px 0px 4px;">
                                          <strong><?= $_SESSION['error']; ?></strong> 
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>                                           

                                      <?php endif; unset($_SESSION['error']);  ?>
                                  
                                    <div class="text-white">
                                        <div class="card-header text-white clearfix" style="background: #112236">
                                            <b class="float-left">All photos list below here</b>
                                            <?php 
                                              $trash_sql   = "SELECT * FROM photos WHERE deleted='1'";
                                              $trash_query = mysqli_query($connect,$trash_sql);
                                              $trash_count = mysqli_num_rows($trash_query);
                                             ?>
                                            <a href="photo-trash-list.php" class="btn btn-success float-right"><span class="badge badge-danger badge-pill float-right"><?= $trash_count; ?></span> <span>  photos Trash  </span>
                                            </a>
                                        </div>

                                        <div class="card-box text-white">
                                            <table class="table table-bordered  text-white table-sm text-center text-dark table-responsive-sm" id="table">
                                             <thead class="bg-custom text-white text-white">
                                                <tr>
                                                    <th>#</th>
                                                    <th>photos</th>
                                                    <th>status</th>
                                                    <th>Created Date</th>
                                                    <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody class="text-white">

                                                <?php
                                                 $i = 1;
                                                 while ($row = mysqli_fetch_assoc($query)) { ?>

                                                 <tr id="table_tr" class="<?= $row['status']==0 ? 'bg-secondary':'';?>">
                                                    <td><?= $i++ ?></td>
                                                                                                        
                                                    <td><img src="../../uploads/photos/<?= $row['photo'];?>" style="width: 40px;height: 40px;" class="rounded-circle"></td>

                                                    <td class="<?php $row['status'] == 0 ? 'bg-secondary':''; ?>">
                                                      <?php if ($row['status'] == 0){ ?>
                                                        <a href="photo-active.php?id=<?=$row['id'];?>" class="text-white"><i class="fas fa-toggle-off" style="font-size: 28px;"></i></a>
                                                      <?php }else{ ?>
                                                         <a href="photo-deactive.php?id=<?=$row['id'];?>" class="text-primary"><i class="fas fa-toggle-on" style="font-size:28px;"></i></a>
                                                      <?php } ?>
                                                    </td>

                                                    <td><?= $row['created_at'];?></td>

                                                    <td>
                                                        <div class="">

                                                            <?php if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 1) { ?>
                                                                <!-- Button trigger modal -->
                                                        <a class="btn text-info" data-toggle="modal" data-target="#exampleModal<?=$row['id']?>">
                                                          <i class="fa fa-edit"></i>
                                                        </a>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal<?= $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                          <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                              <div class="modal-header" style="background: #112236;">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Change photo</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                                              <div class="modal-body" style="background: #112230;">
                                                                <img src="../../uploads/photos/<?= $row['photo'];?>" class="card-img-top" style="width: 100px;height: 100px;">
                                                                <div class="card-box">
                                                                  <form action="" method="post" enctype="multipart/form-data">
                                                                    <?php
                                                                     $edit_id  = $row['id'];
                                                                     $edit_photo_name = $row['photo']; 
                                                                    ?>
                                                                    <input type="hidden" name="id" value="<?= $edit_id; ?>">
                                                                    <input type="hidden" name="edit_photo" value="<?= $edit_photo_name; ?>">
                                                                    <div class="form-group">
                                                                      <label class="text-purple float-left">Select photo :</label>
                                                                      <div class="input-group">
                                                                        <div class="input-group-append">
                                                                          <span class="input-group-text"><i class="fas fa-photo"></i></span>
                                                                        </div>
                                                                        <input type="file" name="photo" class="form-control form-control-sm form-control-file">
                                                                      </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                      <label class="text-purple float-left">Parant banner :</label>
                                                                      <div class="input-group">
                                                                        <div class="input-group-append">
                                                                          <span class="input-group-text"><i class="fas fa-photo"></i></span>
                                                                        </div>
                                                                        <select name="banner_id" class="form-control form-control-sm">
                                                                          <option value="<?= $row['banner_id'] ?>"><?= $row['banner_id']; ?></option>
                                                                        <?php 
                                                                         $select_banner = "SELECT * FROM banners";
                                                                         $select_query  = mysqli_query($connect,$select_banner);
                                                                         while ($select_row = mysqli_fetch_assoc($select_query)) {
                                                                        
                                                                         ?>
                                                                        <option value="<?= $select_row['id'] ?>"><?= $select_row['banner_title']?></option>
                                                                        <?php } ?>
                                                                      </select>
                                                                      </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                      <input type="submit" name="update-photo" value="UPDATE photo" class="btn btn-pink btn-sm btn-block">
                                                                    </div>
                                                                  </form>
                                                                </div>
                                                              </div>
                                                              <div class="modal-footer" style="background: #112235;">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>

                                                            <?php } ?>

                                                            <?php if ($_SESSION['user_role'] == 1) { ?>
                                                                <a href="photo-trash.php?id=<?php echo $row['id'];?>" class="btn text-warning" onclick="return confirm('are your sure move to trash this photo ?')">Trash
                                                                </a>
                                                                
                                                                <a href="photo-delete.php?id=<?= $row['id'];?>&file_name=<?= $row['photo'];?>" class="btn text-danger" title="permanently delete" onclick="return confirm('are you sure permanently delete this photo ?')"><i class="fa fa-trash"></i></a>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                     
                                                <?php  } ?>
                                            </tbody>
                                            <tfoot class="bg-custom text-white">
                                                <tr>
                                                    <th>#</th>
                                                    <th>photos</th>
                                                    <th>Status</th> 
                                                    <th>Created Date</th>   
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                
                            </div>

                            <!-- //right side content add photo -->

                            <div class="col-md-3">
                              <div class="text-white">
                                <div class="card-header" style="background: #112236;">
                                  <div class="font-weight-bold" >Add New photo</div>
                                </div>
                                <div class="card-box">
                                  <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <label class="text-purple">Select photo :</label>
                                      <div class="input-group">
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fas fa-photo"></i></span>
                                        </div>
                                        <input type="file" name="photo" class="form-control form-control-sm form-control-file">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="text-purple">Parant banner :</label>
                                      <div class="input-group">
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fas fa-photo"></i></span>
                                        </div>
                                        <select name="banner_id" class="form-control form-control-sm">
                                          <?php 
                                           $select_banner = "SELECT * FROM banners";
                                           $select_query  = mysqli_query($connect,$select_banner);
                                           while ($select_row = mysqli_fetch_assoc($select_query)) {
                                          
                                           ?>
                                          <option value="<?= $select_row['id'] ?>"><?= $select_row['banner_title']?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <input type="submit" name="add-photo" value="UPLOAD photo" class="btn btn-pink btn-sm btn-block">
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                        </div> 
                    </div> <!-- container -->
                </div> <!-- content -->


<?php require "../../includes/layouts/footer.php"; ?>
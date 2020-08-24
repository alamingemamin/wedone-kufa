<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";


  // add new brand logo into brands_logo table
  if (isset($_POST['add-brand-logo'])) {
    $brand_logo         = $_FILES['brand_logo'];
    $expolde_brand_logo = explode('.',$brand_logo['name']);
    $extension    = strtolower(end($expolde_brand_logo));
    $allowed      = array('png');
    if ($brand_logo['name'] == null) {
      $_SESSION['error'] = "File does not found!!";

    }elseif (!in_array($extension,$allowed)) {
      $_SESSION['error'] = "FIle format must be use png type!!!";

    }elseif ($brand_logo['size'] > (1024*1024)) {
      $_SESSION['error'] = "FIle size is too large!!!";

    }else{
      $insert_brand_logo  = "INSERT INTO brands_logo(status) VALUES('1')";
      $insert_query = mysqli_query($connect,$insert_brand_logo);

      if ($insert_query) {
         $last_id   = mysqli_insert_id($connect);
         $brand_logo_name = $last_id.'.'.$extension;
         $destination = '../../uploads/brand-logos/'.$brand_logo_name;
         if (move_uploaded_file($brand_logo['tmp_name'],$destination)) {
           $update_brand_logo_new  = "UPDATE brands_logo SET brand_logo='$brand_logo_name' WHERE id='$last_id'";
           $update_query_new = mysqli_query($connect,$update_brand_logo_new);

           if ($update_query_new) {
             $_SESSION['success'] = "brand_logo uploaded has been successfully";

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

    // update brand logo from brands_logo table
    if (isset($_POST['update-brand-logo'])) {
    $update_brand_logo  = $_FILES['brand_logo'];
    $update_id    = $_POST['id'];
    $edit_brand_logo    = $_POST['edit_brand_logo'];
    $update_expolde_brand_logo = explode('.',$update_brand_logo['name']);
    $update_extension    = strtolower(end($update_expolde_brand_logo));
    $update_allowed      = array('png');
    if ($update_brand_logo['name'] == null) {
      $_SESSION['error'] = "update File does not found!!";

    }elseif (!in_array($update_extension,$update_allowed)) {
      $_SESSION['error'] = "update FIle format must be use png type!!!";

    }elseif ($update_brand_logo['size'] > (1024*1024)) {
      $_SESSION['error'] = "update FIle size is too large!!!";

    }else{
         if (unlink('../../uploads/brand-logos/'.$edit_brand_logo)) {
            $update_brand_logo_name = $update_id.'.'.$update_extension;
            $update_destination = '../../uploads/brand-logos/'.$update_brand_logo_name;
           if (move_uploaded_file($update_brand_logo['tmp_name'],$update_destination)) {
             $update_brand_logo_sql   = "UPDATE brands_logo SET brand_logo='$update_brand_logo_name' WHERE id='$update_id'";
             $update_brand_logo_query = mysqli_query($connect,$update_brand_logo_sql);

             if ($update_brand_logo_query) {
               $_SESSION['success'] = "brand_logo has been updated successfully";
             }else{
              $_SESSION['error'] = "OPSSS!!!,brand_logo does not updated";
             }

           }else{
            $_SESSION['error'] = "Update file does not upload!!";

           }
         }else{
          $_SESSION['error'] = "old brand_logo does not delete!!!";

         }
         

     
    }
  }

  $sql   = "SELECT * FROM brands_logo WHERE deleted='0' ORDER BY id DESC";
  $query = mysqli_query($connect,$sql);

$title = "All brand logos list page";
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
                                            <b class="float-left">All brand logos list below here</b>
                                            <?php 
                                              $trash_sql   = "SELECT * FROM brands_logo WHERE deleted='1'";
                                              $trash_query = mysqli_query($connect,$trash_sql);
                                              $trash_count = mysqli_num_rows($trash_query);
                                             ?>
                                            <a href="brand-logo-trash-list.php" class="btn btn-success float-right"><span class="badge badge-danger badge-pill float-right"><?= $trash_count; ?></span> <span>  brand logos Trash  </span>
                                            </a>
                                        </div>

                                        <div class="card-box text-white">
                                            <table class="table table-bordered  text-white table-sm text-center text-dark table-responsive-sm" id="table">
                                             <thead class="bg-custom text-white text-white">
                                                <tr>
                                                    <th>#</th>
                                                    <th>brand logos</th>
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
                                                                                                        
                                                    <td><img src="../../uploads/brand-logos/<?= $row['brand_logo'];?>" style="width: 40px;height: 40px;" class="rounded-circle"></td>

                                                    <td class="<?php $row['status'] == 0 ? 'bg-secondary':''; ?>">
                                                      <?php if ($row['status'] == 0){ ?>
                                                        <a href="brand-logo-active.php?id=<?=$row['id'];?>" class="text-white"><i class="fas fa-toggle-off" style="font-size: 28px;"></i></a>
                                                      <?php }else{ ?>
                                                         <a href="brand-logo-deactive.php?id=<?=$row['id'];?>" class="text-primary"><i class="fas fa-toggle-on" style="font-size:28px;"></i></a>
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
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Change brand logo</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                                              <div class="modal-body" style="background: #112230;">
                                                                <img src="../../uploads/brand-logos/<?= $row['brand_logo'];?>" class="card-img-top" style="width: 100px;height: 100px;">
                                                                <div class="card-box">
                                                                  <form action="" method="post" enctype="multipart/form-data">
                                                                    <?php
                                                                     $edit_id  = $row['id'];
                                                                     $edit_brand_logo_name = $row['brand_logo']; 
                                                                    ?>
                                                                    <input type="hidden" name="id" value="<?= $edit_id; ?>">
                                                                    <input type="hidden" name="edit_brand_logo" value="<?= $edit_brand_logo_name; ?>">
                                                                    <div class="form-group">
                                                                      <label class="text-purple float-left">Select brand_logo :</label>
                                                                      <div class="input-group">
                                                                        <div class="input-group-append">
                                                                          <span class="input-group-text"><i class="fas fa-photo"></i></span>
                                                                        </div>
                                                                        <input type="file" name="brand_logo" class="form-control form-control-sm form-control-file">
                                                                      </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                      <input type="submit" name="update-brand-logo" value="UPDATE brand_logo" class="btn btn-pink btn-sm btn-block">
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
                                                                <a href="brand-logo-trash.php?id=<?php echo $row['id'];?>" class="btn text-warning" onclick="return confirm('are your sure move to trash this brand_logo ?')">Trash
                                                                </a>
                                                                
                                                                <a href="brand-logo-delete.php?id=<?= $row['id'];?>&file_name=<?= $row['brand_logo'];?>" class="btn text-danger" title="permanently delete" onclick="return confirm('are you sure permanently delete this brand_logo ?')"><i class="fa fa-trash"></i></a>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                     
                                                <?php  } ?>
                                            </tbody>
                                            <tfoot class="bg-custom text-white">
                                                <tr>
                                                    <th>#</th>
                                                    <th>brand logos</th>
                                                    <th>Status</th> 
                                                    <th>Created Date</th>   
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                
                            </div>

                            <!-- //right side content add brand_logo -->

                            <div class="col-md-3">
                              <div class="text-white">
                                <div class="card-header" style="background: #112236;">
                                  <div class="font-weight-bold" >Add New brand_logo</div>
                                </div>
                                <div class="card-box">
                                  <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <label class="text-purple">Select brand logo :</label>
                                      <div class="input-group">
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fas fa-photo"></i></span>
                                        </div>
                                        <input type="file" name="brand_logo" class="form-control form-control-sm form-control-file">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <input type="submit" name="add-brand-logo" value="UPLOAD brand_logo" class="btn btn-pink btn-sm btn-block">
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                        </div> 
                    </div> <!-- container -->
                </div> <!-- content -->


<?php require "../../includes/layouts/footer.php"; ?>
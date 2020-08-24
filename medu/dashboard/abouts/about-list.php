<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";

  if (isset($_POST['add-about'])) {
    $banner_id     = $_POST['banner_id'];
    $description   = mysqli_real_escape_string($connect,trim(htmlentities($_POST['description'])));

    if (empty($description)) {
      $_SESSION['error']  = "Description is required";

    }else{
      $insert_about  = "INSERT INTO abouts(description,banner_id) VALUES('$description','$banner_id')";
      $insert_query = mysqli_query($connect,$insert_about);

      
      if ($insert_query) {
        $_SESSION['success'] = "About has been published successfully";

      }else{
        $_SESSION['error']  = "Oppss!!,About does not published!!!";
      }

    }
  }


    if (isset($_POST['update-about'])) {
        $update_description  = mysqli_real_escape_string($connect,trim(htmlentities($_POST['description'])));
        $update_id           = $_POST['id'];
        $update_banner_id    = $_POST['banner_id'];

      if (empty($update_description)) {
        $_SESSION['error'] = "update Description does not found!!";

       }else{
           
        $update_about_sql   = "UPDATE abouts SET description='$update_description', banner_id='$update_banner_id' WHERE id='$update_id'";
        $update_about_query = mysqli_query($connect,$update_about_sql);
        if ($update_about_query) {
            $_SESSION['success'] = "About updated has been succesfully!!";
            
        }else{
           $_SESSION['error'] = "About does not updated!!";
        }  
    }
  }

  $sql   = "SELECT * FROM abouts WHERE deleted='0' ORDER BY id DESC";
  $query = mysqli_query($connect,$sql);

$title = "All About list page";
?>
<?php require "../../includes/layouts/header.php"; ?>

      <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 text-white">
                                
                                   
                                    	
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
                                              $trash_sql   = "SELECT * FROM abouts WHERE deleted='1'";
                                              $trash_query = mysqli_query($connect,$trash_sql);
                                              $trash_count = mysqli_num_rows($trash_query);
                                             ?>
                                            <a href="about-trash-list.php" class="btn btn-success float-right"><span class="badge badge-danger badge-pill float-right"><?= $trash_count; ?></span> <span>  Abouts Trash  </span>
                                            </a>
                                        </div>

                                        <div class="card-box text-white">
                                            <table class="table table-bordered  text-white table-sm text-center text-dark table-responsive-sm" id="table">
                                             <thead class="bg-custom text-white text-white">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Parent banner</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                  
                                                    <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody class="text-white">

                                                <?php
                                                 $i = 1;
                                                 while ($row = mysqli_fetch_assoc($query)) { ?>

                                                 <tr id="table_tr" class="<?= $row['status']==0 ? 'bg-secondary':'';?>" >
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $row['banner_id'];?></td>                                                      
                                                    <td><?= substr($row['description'], 0,20)."...";?></td>                                                      
                                                  
                                                    <td class="<?php $row['status'] == 0 ? 'bg-secondary':''; ?>">
                                                      <?php if ($row['status'] == 0){ ?>
                                                        <a href="about-active.php?id=<?=$row['id'];?>" class="text-white"><i class="fas fa-toggle-off" style="font-size: 28px;"></i></a>
                                                      <?php }else{ ?>
                                                         <a href="about-deactive.php?id=<?=$row['id'];?>" class="text-primary"><i class="fas fa-toggle-on" style="font-size:28px;"></i></a>
                                                      <?php } ?>
                                                    </td>

                                                

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
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Change about</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                                              <div class="modal-body" style="background: #112230;">
                                                                
                                                                <div class="card-box">
                                                                  <form action="" method="post" enctype="multipart/form-data">
                                                                    <?php
                                                                     $edit_id  = $row['id']; 
                                                                    ?>
                                                                    <input type="hidden" name="id" value="<?= $edit_id; ?>">
                                                                    <div class="form-group">
                                                                      <label class="text-purple float-left">Description:</label>
                                                                      <div class="input-group">
                                                                        <div class="input-group-append">
                                                                          <span class="input-group-text"><i class="fas fa-photo"></i></span>
                                                                        </div>
                                                                        <textarea name="description" class="form-control" rows="6" col="6"><?= $row['description'] ?></textarea>
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
                                                                      <input type="submit" name="update-about" value="Update About" class="btn btn-pink btn-sm btn-block">
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
                                                                <a href="about-trash.php?id=<?php echo $row['id'];?>" class="btn text-warning" onclick="return confirm('are your sure move to trash this about ?')">Trash
                                                                </a>
                                                                
                                                                <a href="about-delete.php?id=<?= $row['id'];?>" class="btn text-danger" title="permanently delete" onclick="return confirm('are you sure permanently delete this about ?')"><i class="fa fa-trash"></i></a>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                     
                                                <?php  } ?>
                                            </tbody>
                                            <tfoot class="bg-custom text-white">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Parent Banner</th>
                                                    <th>Description</th>
                                                    <th>Status</th> 
                                                 
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                
                            </div>

                            <!-- //right side content add about -->

                            <div class="col-md-4">
                              <div class="text-white">
                                <div class="card-header" style="background: #112236;">
                                  <div class="font-weight-bold" >Add New About</div>
                                </div>
                                <div class="card-box">
                                  <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <label class="text-purple">Description :</label>
                                      <div class="input-group">
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fas fa-photo"></i></span>
                                        </div>
                                       <textarea name="description" class="form-control" cols="6" rows="6">
                                         <?php if (isset($_POST['description'])) {
                                           echo $_POST['description'];
                                         }?>
                                       </textarea>
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
                                      <input type="submit" name="add-about" value="Publish About" class="btn btn-pink btn-sm btn-block">
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                        </div> 
                    </div> <!-- container -->
                </div> <!-- content -->


<?php require "../../includes/layouts/footer.php"; ?>
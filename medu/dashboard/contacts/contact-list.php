<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";


  // add new contact into contacts table
  if (isset($_POST['add-contact'])) {
    $banner_id = $_POST['banner_id'];
    $email     = mysqli_real_escape_string($connect,trim($_POST['email']));
    $phone     = mysqli_real_escape_string($connect,trim($_POST['phone']));
    $address   = mysqli_real_escape_string($connect,trim($_POST['address']));
    $city      = mysqli_real_escape_string($connect,trim($_POST['city']));

    if (empty($email)) {
      $_SESSION['error']  = "email is required";

    }elseif (empty($city)) {
      $_SESSION['error']  = "city is required";

    }elseif (empty($phone)) {
      $_SESSION['error']  = "Phone is required";

    }elseif (empty($address)) {
      $_SESSION['error']  = "Address is required";

    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
      $_SESSION['error']  = "email must be use a valid email";

    }elseif (!is_numeric($phone)) {
      $_SESSION['error']  = "Phone number must be use number";

    }elseif (strlen($phone) < 9 || strlen($phone) > 11) {
      $_SESSION['error']  = "Phone number use must be use 9 to 11 number";

    }else{
      $insert_contact  = "INSERT INTO contacts(city,address,phone,email,banner_id) VALUES('$city','$address','$phone','$email','$banner_id')";
      $insert_query = mysqli_query($connect,$insert_contact);

      
      if ($insert_query) {
        $_SESSION['success'] = "Contact has been published successfully";

      }else{
        $_SESSION['error']  = "Oppss!!,contact does not published!!!";
      }

    }
  }


// update contact from contacts table
if (isset($_POST['update-contact'])) {
    $update_id           = $_POST['id'];
    $update_banner_id    = $_POST['banner_id'];
    $update_email        = mysqli_real_escape_string($connect,trim($_POST['email']));
    $update_phone        = mysqli_real_escape_string($connect,trim($_POST['phone']));
    $update_address      = mysqli_real_escape_string($connect,trim($_POST['address']));
    $update_city         = mysqli_real_escape_string($connect,trim($_POST['city']));

    if (empty($update_email)) {
      $_SESSION['error']  = "email is required";

    }elseif (empty($update_city)) {
      $_SESSION['error']  = "City is required";

    }elseif (empty($update_phone)) {
      $_SESSION['error']  = "Phone is required";

    }elseif (empty($update_address)) {
      $_SESSION['error']  = "Address is required";

    }elseif (!filter_var($update_email,FILTER_VALIDATE_EMAIL)) {
      $_SESSION['error']  = "email must be use a valid email";

    }elseif (!is_numeric($update_phone)) {
      $_SESSION['error']  = "Phone number must be use number";

    }elseif (strlen($update_phone) < 9 || strlen($update_phone) > 11) {
      $_SESSION['error']  = "Phone number use must be use 9 to 11 number";

    }else{
      $update_contact  = "UPDATE contacts SET city='$update_city', address='$update_address', phone='$update_phone', email='$update_email', banner_id='$update_banner_id' WHERE id='$update_id'";
      $update_query = mysqli_query($connect,$update_contact);

      
      if ($update_query) {
        $_SESSION['success'] = "Contact has been Updated successfully";

      }else{
        $_SESSION['error']  = "Oppss!!,contact does not Update!!!";
      }

    }
  }


  $sql   = "SELECT * FROM contacts WHERE deleted='0' ORDER BY id DESC";
  $query = mysqli_query($connect,$sql);

$title = "Contacts list page";
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
                                            <script type="text/javascript">
                                              Swal.fire({
                                                icon: 'error',
                                                html:'<p><b class="text-danger"><i class="fa fa-warning"></i></b>&nbsp&nbsp&nbsp<span class="text-warning"><?php echo $_SESSION['error']; ?></span></p>'
                                              });
                                            </script>

                                        <?php endif; unset($_SESSION['error']);  ?>



                                        


                                  
                                    <div class="text-white">
                                        <div class="card-header text-white clearfix" style="background: #112236">
                                          <?php 

                                          $trash_sql   = "SELECT * FROM contacts WHERE deleted='1' ORDER BY id DESC";
                                          $trash_query = mysqli_query($connect,$trash_sql);
                                          $trash_count = mysqli_num_rows($trash_query);
                                           ?>
                                          <b class="float-left">Contacts list below here</b><a href="contact-trash-list.php" class="btn btn-success float-right"><span class="badge badge-danger badge-pill float-right"><?= $trash_count; ?></span><span>Contacts Trash</span></a>
                                        </div>
                                        <div class="card-box text-white">
                                            <table class="table table-bordered  text-white table-sm text-center text-dark table-responsive-sm" id="table">
                                             <thead class="bg-custom text-white text-white">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody class="text-white">

                                                <?php
                                                $i = 1;
                                                 while ($row = mysqli_fetch_assoc($query)) { ?>

                                                 <tr id="table_tr" class="<?= $row['status']==0 ? 'bg-secondary':'';?>" >
                                                    <td><?= $i++; ?> </td>

                                                    <td><?= $row['email']; ?> </td>

                                                    <td><?= $row['phone']; ?></td>
                                                    <td>
                                                        <?php
                                                         if ($row['status'] == 1) { ?>
                                                            <a href="contact-deactive.php?id=<?= $row['id']?>" class="btn" title="active"><i class="fas fa-toggle-on" style="font-size: 28px;"></i></a>
                                                         <?php }else { ?>
                                                           <a href="contact-active.php?id=<?= $row['id']?>" class="btn text-white" title="deactive"><i class="fas fa-toggle-off" style="font-size: 28px;"></i></a>
                                                         <?php  } 
                                                        ?>
                                                        
                                                    </td>
                                   
                                                    
                                                    <td>
                                                        <div class="btn-group">

                                                          <?php if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 3) { ?>

                                                                <a class="btn text-info" data-toggle="modal" data-target="#exampleModalView<?=$row['id']?>">
                                                          <i class="fa fa-eye"></i>
                                                        </a>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModalView<?= $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                          <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                              <div class="modal-header" style="background: #112236;">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Change Contact</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                                              <div class="modal-body" style="background: #112230;">
                                                                
                                                                <div class="card-box">
                                                                  <table class="table table-sm table-bordered" style="background: #112237;">
                                                                    <tr>
                                                                      <th class="text-purple text-left">City Name</th>
                                                                      <td class="text-success text-left"><?= $row['city']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                      <th class="text-purple text-left">Email</th>
                                                                      <td class="text-success text-left"><?= $row['email']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                      <th class="text-purple text-left">Phone</th>
                                                                      <td class="text-success text-left"><?= $row['phone']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                      <th class="text-purple text-left">Address</th>
                                                                      <td class="text-success text-left"><?= $row['address']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                      <th class="text-purple text-left">Parent Banner</th>
                                                                      <td class="text-success text-left"><?= $row['banner_id']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                      <th class="text-purple text-left">Created Date</th>
                                                                      <td class="text-success text-left"><?= $row['created_at']; ?></td>
                                                                    </tr>
                                                                  </table>
                                                                </div>
                                                              </div>
                                                              <div class="modal-footer" style="background: #112235;">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>

                                                            <?php } ?>

                                                            <?php if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 1) { ?>

                                                                <a class="btn text-info" data-toggle="modal" data-target="#exampleModal<?=$row['id']?>">
                                                          <i class="fa fa-edit"></i>
                                                        </a>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal<?= $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                          <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                              <div class="modal-header" style="background: #112236;">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Change Contact</h5>
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
                                                                      <label class="text-purple float-left">City Name</label>
                                                                      <div class="input-group">
                                                                        <div class="input-group-append">
                                                                          <span class="input-group-text"><i class="fas fa-landmark"></i></span>
                                                                        </div>
                                                                        <input type="text" name="city" class="form-control form-control-sm" placeholder="City" value="<?= $row['city']; ?>"> 
                                                                      </div>
                                                                    </div>

                                                                   <div class="form-group">
                                                                      <label class="text-purple float-left">Email</label>
                                                                      <div class="input-group">
                                                                        <div class="input-group-append">
                                                                          <span class="input-group-text"><i class="fas fa-at"></i></span>
                                                                        </div>
                                                                        <input type="email" name="email" class="form-control form-control-sm"  value="<?= $row['email'];?>"> 
                                                                      </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                      <label class="text-purple float-left">Phone</label>
                                                                      <div class="input-group">
                                                                        <div class="input-group-append">
                                                                          <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                                        </div>
                                                                        <input type="number" name="phone" class="form-control form-control-sm"  value="<?= $row['phone'];?>"> 
                                                                      </div>
                                                                    </div>  

                                                                    <div class="form-group">
                                                                      <label class="text-purple float-left">Address</label>
                                                                      <div class="input-group">
                                                                        <div class="input-group-append">
                                                                          <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                                                                        </div>
                                                                        <input type="text" name="address" class="form-control form-control-sm" value="<?= $row['address']; ?>"> 
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
                                                                      <input type="submit" name="update-contact" value="Update Contact" class="btn btn-pink btn-sm btn-block">
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
                                                              <a href="contact-trash.php?id=<?php echo $row['id'];?>" class="btn text-warning" onclick="return confirm('are your sure move to trash this contact ?')">Trash
                                                                </a>
                                                                <a href="contact-delete.php?id=<?php echo $row['id'];?>" class="btn text-danger" onclick="return confirm('are your sure delete this contact ?')" title="permanently delete"><i class="fa fa-trash"></i>
                                                                </a>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                     
                                                <?php  } ?>
                                            </tbody>
                                            <tfoot class="bg-custom text-white">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                             
                              <!-- //right side content add contact -->

                            <div class="col-md-4">
                              <div class="text-white">
                                <div class="card-header" style="background: #112236;">
                                  <div class="font-weight-bold" >Add New Contacts</div>
                                </div>
                                <div class="card-box">
                                  <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <label class="text-purple">City Name</label>
                                      <div class="input-group">
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fas fa-landmark"></i></span>
                                        </div>
                                        <input type="text" name="city" class="form-control form-control-sm" placeholder="City" value="<?php if (isset($_POST['city'])) {
                                           echo $_POST['city'];
                                         }?>"> 
                                      </div>
                                    </div>
 

                                    <div class="form-group">
                                      <label class="text-purple">Email</label>
                                      <div class="input-group">
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fas fa-at"></i></span>
                                        </div>
                                        <input type="email" name="email" class="form-control form-control-sm" placeholder="E-Mail" value="<?php if (isset($_POST['email'])) {
                                           echo $_POST['email'];
                                         }?>"> 
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="text-purple">Phone</label>
                                      <div class="input-group">
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="number" name="phone" class="form-control form-control-sm" placeholder="Phone Number" value="<?php if (isset($_POST['phone'])) {
                                           echo $_POST['phone'];
                                         }?>"> 
                                      </div>
                                    </div>  

                                    <div class="form-group">
                                      <label class="text-purple">Address</label>
                                      <div class="input-group">
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                                        </div>
                                        <input type="text" name="address" class="form-control form-control-sm" placeholder="Address " value="<?php if (isset($_POST['address'])) {
                                           echo $_POST['address'];
                                         }?>"> 
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
                                      <input type="submit" name="add-contact" value="Publish Contact" class="btn btn-pink btn-sm btn-block">
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                        </div> 
                    </div> <!-- container -->
                </div> <!-- content -->


<?php require "../../includes/layouts/footer.php"; ?>
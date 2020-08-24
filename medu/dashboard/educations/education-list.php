<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";
  
  // education skill insert here into educations table
  if (isset($_POST['add-education'])) {
    $banner_id = $_POST['banner_id'];
    $name      = mysqli_real_escape_string($connect,trim($_POST['name']));
    $year      = mysqli_real_escape_string($connect,trim($_POST['year']));
    $rank      = mysqli_real_escape_string($connect,trim($_POST['rank']));


    if (empty($name)) {
      $_SESSION['error']  = "Education name is required";

    }elseif (empty($year)) {
      $_SESSION['error']  = "Passing year is required";

    }elseif (empty($rank)) {
      $_SESSION['error']  = "Rank is required";

    }elseif (!is_numeric($year)) {
      $_SESSION['error']  = "Year Must be use number";

    }elseif (!is_numeric($rank)) {
      $_SESSION['error']  = "Rank must be use number";

    }elseif (is_numeric($name)) {
      $_SESSION['error']  = "name  must be use alphabatic character";

    }elseif (strlen($year) < 4 || strlen($year) > 4) {
      $_SESSION['error']  = "Year use must be use 4 number";

    }elseif (strlen($rank) < 1 || strlen($year) > 4) {
      $_SESSION['error']  = "Rank  use must be use 1-3 number";

    }else{
      $insert_education  = "INSERT INTO educations(name,year,rank,banner_id) VALUES('$name','$year','$rank','$banner_id')";
      $insert_query = mysqli_query($connect,$insert_education);

      
      if ($insert_query) {
        $_SESSION['success'] = "education has been published successfully";

      }else{
        $_SESSION['error']  = "Oppss!!,education does not published!!!";
      }

    }
  }


// update education skills from educations table
if (isset($_POST['update-education'])) {
    $update_id           = $_POST['id'];
    $update_banner_id    = $_POST['banner_id'];
    $update_name         = mysqli_real_escape_string($connect,trim($_POST['name']));
    $update_year         = mysqli_real_escape_string($connect,trim($_POST['year']));
    $update_rank         = mysqli_real_escape_string($connect,trim($_POST['rank']));


    if (empty($update_name)) {
      $_SESSION['error']  = "name is required";

    }elseif (empty($update_year)) {
      $_SESSION['error']  = "year is required";

    }elseif (empty($update_rank)) {
      $_SESSION['error']  = "rank is required";

    }elseif (is_numeric($update_name)) {
      $_SESSION['error']  = "Name must be use alphabatic character";

    }elseif (!is_numeric($update_year)) {
      $_SESSION['error']  = "Year must be use number";

    }elseif (!is_numeric($update_rank)) {
      $_SESSION['error']  = "Rank must be use number";

    }elseif (strlen($update_year) < 4 || strlen($update_year) > 4) {
      $_SESSION['error']  = "Year number use must be use 4 number";

    }elseif (strlen($update_rank) < 1 || strlen($update_year) > 4) {
      $_SESSION['error']  = "Rank number use must be use 1-3 number";

    }
    else{
      $update_education  = "UPDATE educations SET name='$update_name', year='$update_year', rank='$update_rank', banner_id='$update_banner_id' WHERE id='$update_id'";
      $update_query = mysqli_query($connect,$update_education);

      
      if ($update_query) {
        $_SESSION['success'] = "education has been Updated successfully";

      }else{
        $_SESSION['error']  = "Oppss!!,education does not Update!!!";
      }

    }
  }


  $sql   = "SELECT * FROM educations WHERE deleted='0' ORDER BY id DESC";
  $query = mysqli_query($connect,$sql);

$title = "educations list page";
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

                                          $trash_sql   = "SELECT * FROM educations WHERE deleted='1' ORDER BY id DESC";
                                          $trash_query = mysqli_query($connect,$trash_sql);
                                          $trash_count = mysqli_num_rows($trash_query);
                                           ?>
                                          <b class="float-left">educations list below here</b><a href="education-trash-list.php" class="btn btn-success float-right"><span class="badge badge-danger badge-pill float-right"><?= $trash_count; ?></span><span>educations Trash</span></a>
                                        </div>
                                        <div class="card-box text-white">
                                            <table class="table table-bordered  text-white table-sm text-center text-dark table-responsive-sm" id="table">
                                             <thead class="bg-custom text-white text-white">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Year</th>
                                                    <th>Rank</th>
                                                    <th>Banner</th>
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

                                                    <td><?= $row['name']; ?> </td>

                                                    <td><?= $row['year']; ?></td>
                                                    <td><?= $row['rank']?></td>
                                                    <td><?= $row['banner_id']?></td>
                                                    <td>
                                                        <?php
                                                         if ($row['status'] == 1) { ?>
                                                            <a href="education-deactive.php?id=<?= $row['id']?>" class="btn" title="active"><i class="fas fa-toggle-on" style="font-size: 28px;"></i></a>
                                                         <?php }else { ?>
                                                           <a href="education-active.php?id=<?= $row['id']?>" class="btn text-white" title="deactive"><i class="fas fa-toggle-off" style="font-size: 28px;"></i></a>
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
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Change education</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                                              <div class="modal-body" style="background: #112230;">
                                                                
                                                                <div class="card-box">
                                                                  <table class="table table-sm table-bordered" style="background: #112237;">
                                                                    <tr>
                                                                      <th class="text-purple text-left"> Name</th>
                                                                      <td class="text-success text-left"><?= $row['name']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                      <th class="text-purple text-left">Year</th>
                                                                      <td class="text-success text-left"><?= $row['year']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                      <th class="text-purple text-left">Rank</th>
                                                                      <td class="text-success text-left"><?= $row['rank']; ?></td>
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
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Change education</h5>
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
                                                                      <label class="text-purple float-left">Name</label>
                                                                      <div class="input-group">
                                                                        <div class="input-group-append">
                                                                          <span class="input-group-text"><i class="fas fa-user-graduate"></i></span>
                                                                        </div>
                                                                        <input type="text" name="name" class="form-control form-control-sm" value="<?= $row['name']; ?>"> 
                                                                      </div>
                                                                    </div>

                                                                   <div class="form-group">
                                                                      <label class="text-purple float-left">Year</label>
                                                                      <div class="input-group">
                                                                        <div class="input-group-append">
                                                                          <span class="input-group-text"><i class="fas fa-at"></i></span>
                                                                        </div>
                                                                        <input type="number" name="year" class="form-control form-control-sm"  value="<?= $row['year'];?>"> 
                                                                      </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                      <label class="text-purple float-left">Avarage Rank Point</label>
                                                                      <div class="input-group">
                                                                        <div class="input-group-append">
                                                                          <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                                        </div>
                                                                        <input type="number" name="rank" class="form-control form-control-sm"  value="<?= $row['rank'];?>"> 
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
                                                                      <input type="submit" name="update-education" value="Update education" class="btn btn-pink btn-sm btn-block">
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
                                                              <a href="education-trash.php?id=<?php echo $row['id'];?>" class="btn text-warning" onclick="return confirm('are your sure move to trash this education ?')">Trash
                                                                </a>
                                                                <a href="education-delete.php?id=<?php echo $row['id'];?>" class="btn text-danger" onclick="return confirm('are your sure delete this education ?')" title="permanently delete"><i class="fa fa-trash"></i>
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
                                                    <th>Name</th>
                                                    <th>Year</th>
                                                    <th>Rank</th>
                                                    <th>Banner</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                             
                              <!-- //right side content add education -->

                            <div class="col-md-4">
                              <div class="text-white">
                                <div class="card-header" style="background: #112236;">
                                  <div class="font-weight-bold" >Add New educations</div>
                                </div>
                                <div class="card-box">
                                  <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <label class="text-purple">Name</label>
                                      <div class="input-group">
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fas fa-user-graduate"></i></span>
                                        </div>
                                        <input type="text" name="name" class="form-control form-control-sm" placeholder="Education name" value="<?php if (isset($_POST['name'])) {
                                           echo $_POST['name'];
                                         }?>"> 
                                      </div>
                                    </div>
 

                                    <div class="form-group">
                                      <label class="text-purple">Year</label>
                                      <div class="input-group">
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fas fa-at"></i></span>
                                        </div>
                                        <input type="year" name="year" class="form-control form-control-sm" placeholder="Pass Year" value="<?php if (isset($_POST['year'])) {
                                           echo $_POST['year'];
                                         }?>"> 
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="text-purple">Avarage Rank Piont</label>
                                      <div class="input-group">
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="number" name="rank" class="form-control form-control-sm" placeholder="Rank between 1-100" value="<?php if (isset($_POST['rank'])) {
                                           echo $_POST['rank'];
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
                                      <input type="submit" name="add-education" value="Publish education" class="btn btn-pink btn-sm btn-block">
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                        </div> 
                    </div> <!-- container -->
                </div> <!-- content -->


<?php require "../../includes/layouts/footer.php"; ?>
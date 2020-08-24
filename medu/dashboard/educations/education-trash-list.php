<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";



  $sql   = "SELECT * FROM educations WHERE deleted='1' ORDER BY id DESC";
  $query = mysqli_query($connect,$sql);

$title = "educations trash list page";
?>
<?php require "../../includes/layouts/header.php"; ?>

      <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 text-white">
                                
                                   
                                      
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

                                          $trash_sql   = "SELECT * FROM educations WHERE deleted='0' ORDER BY id DESC";
                                          $trash_query = mysqli_query($connect,$trash_sql);
                                          $trash_count = mysqli_num_rows($trash_query);
                                           ?>
                                          <b class="float-left">educations list below here</b><a href="education-list.php" class="btn btn-success float-right"><span class="badge badge-danger badge-pill float-right"><?= $trash_count; ?></span><span>educations Trash</span></a>
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
                                                 while ($row = mysqli_fetch_assoc($query)) { ?>

                                                 <tr id="table_tr">
                                                    <td><?= $row['id']; ?> </td>

                                                    <td><?= $row['name']; ?> </td>

                                                    <td><?= $row['year']; ?></td>
                                                    <td><?= $row['rank']?></td>
                                                    <td><?= $row['banner_id']?></td>
                                                    <td>
                                                        <?php
                                                         if ($row['status'] == 1) { ?>
                                                            <a href="education-deactive.php?id=<?= $row['id']?>" class="btn" title="active"><i class="fas fa-toggle-on" style="font-size: 28px;"></i></a>
                                                         <?php }else { ?>
                                                           <a href="education-active.php?id=<?= $row['id']?>" class="btn text-secondary" title="deactive"><i class="fas fa-toggle-off" style="font-size: 28px;"></i></a>
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

                                                            

                                                            <?php if ($_SESSION['user_role'] == 1) { ?>
                                                              <a href="education-restore.php?id=<?php echo $row['id'];?>" class="btn text-warning" onclick="return confirm('are your sure restore education ?')">Restore
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

                        </div> 
                    </div> <!-- container -->
                </div> <!-- content -->


<?php require "../../includes/layouts/footer.php"; ?>
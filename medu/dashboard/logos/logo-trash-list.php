<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";
  $sql   = "SELECT * FROM logos WHERE deleted='1' ORDER BY id DESC";
  $query = mysqli_query($connect,$sql);

$title = "All logos list page";
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

                                        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="border-left: 5px solid #ff0000; border-radius: 4px 0px 0px 4px;">
                                          <strong><?= $_SESSION['error']; ?></strong> 
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>                                           

                                      <?php endif; unset($_SESSION['error']);  ?>
                                  
                                    <div class="text-white">
                                        <div class="card-header text-white clearfix" style="background: #112236">
                                            <b class="float-left">All logos list below here</b>
                                            <?php 
                                              $trash_sql   = "SELECT * FROM logos WHERE deleted='0'";
                                              $trash_query = mysqli_query($connect,$trash_sql);
                                              $trash_count = mysqli_num_rows($trash_query);
                                             ?>
                                            <a href="logos-list.php" class="btn btn-success float-right"><span class="badge badge-danger badge-pill float-right"><?= $trash_count; ?></span> <span>  Logos list </span>
                                            </a>
                                        </div>

                                        <div class="card-box text-white">
                                            <table class="table table-bordered  text-white table-sm text-center text-dark table-responsive-sm" id="table">
                                             <thead class="bg-custom text-white text-white">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Logos</th>
                                                    <th>status</th>
                                                    <th>Created Date</th>
                                                    <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody class="text-white">

                                                <?php
                                                 $i = 1;
                                                 while ($row = mysqli_fetch_assoc($query)) { ?>

                                                 <tr id="table_tr">
                                                    <td><?= $i++ ?></td>
                                                                                                        
                                                    <td><img src="../../uploads/logos/<?= $row['logo'];?>" style="width: 40px;height: 40px;" class="rounded-circle"></td>

                                                    <td class="<?php $row['status'] == 0 ? 'bg-secondary':''; ?>">
                                                      <?php if ($row['status'] == 0){ ?>
                                                        <a href="logo-active.php?id=<?=$row['id'];?>" class="text-secondary"><i class="fas fa-toggle-off" style="font-size: 28px;"></i></a>
                                                      <?php }else{ ?>
                                                         <a href="logo-deactive.php?id=<?=$row['id'];?>" class="text-primary"><i class="fas fa-toggle-on" style="font-size:28px;"></i></a>
                                                      <?php } ?>
                                                    </td>

                                                    <td><?= $row['created_at'];?></td>
                                                    <td>
                                                        <div class="">

                                                            <?php if ($_SESSION['user_role'] == 1) { ?>
                                                                <a href="logo-restore.php?id=<?php echo $row['id'];?>" class="btn text-warning" onclick="return confirm('are your sure Restore this logo ?')">Restore
                                                                </a>
                                                                
                                                                <a href="logo-delete.php?id=<?= $row['id'];?>&file_name=<?= $row['logo'];?>" class="btn text-danger" title="permanently delete" onclick="return confirm('are you sure permanently delete this logo ?')"><i class="fa fa-trash"></i></a>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                     
                                                <?php  } ?>
                                            </tbody>
                                            <tfoot class="bg-custom text-white">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Logos</th>
                                                    <th>Status</th> 
                                                    <th>Created Date</th>   
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
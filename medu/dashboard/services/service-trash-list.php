<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";
  $sql   = "SELECT * FROM services WHERE deleted='1' ORDER BY id DESC";
  $query = mysqli_query($connect,$sql);

$title = "Services list page";
?>
<?php require "../../includes/layouts/header.php"; ?>

      <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 text-white">
                                
                                   
                                    	
                                    	<?php if(isset($_SESSION['success'])): ?>
                                            <script type="text/javascript">
                                              Swal.fire({
                                                icon: 'success',
                                                html:'<p><b class="text-success"><i class="fa fa-ok"></i></b>&nbsp&nbsp&nbsp<span class="text-success"><?php echo $_SESSION['success']; ?></span></p>'
                                              });
                                            </script>

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
                                          <b class="float-left">Services trash list below here</b><a href="service-list.php" class="btn btn-success float-right">Back to Service</a>
                                        </div>
                                        <div class="card-box text-white">
                                            <table class="table table-bordered  text-white table-sm text-center text-dark table-responsive-sm" id="table">
                                             <thead class="bg-custom text-white text-white">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Service Icon</th>
                                                    <th>Service Title</th>
                                                    <th>Status</th>
                                                    <th>Service Description</th>
                                                    <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody class="text-white">

                                                <?php
                                                 while ($row = mysqli_fetch_assoc($query)) { ?>

                                                 <tr id="table_tr">
                                                    <td><?= $row['id']; ?></td>

                                                    <td title="<?= $row['service_icon']; ?>"><i class="<?= $row['service_icon']; ?>" style="color:<?= $row['service_icon_color']; ?>;"></i>
                                                    </td>

                                                    <td><?= $row['service_title']; ?></td>
                                                    <td>
                                                        <?php
                                                         if ($row['status'] == 1) { ?>
                                                            <a href="service-deactive.php?id=<?= $row['id']?>" class="btn" title="active"><i class="fas fa-toggle-on" style="font-size: 28px;"></i></a>
                                                         <?php }else { ?>
                                                           <a href="service-active.php?id=<?= $row['id']?>" class="btn text-secondary" title="deactive"><i class="fas fa-toggle-off" style="font-size: 28px;"></i></a>
                                                         <?php  } 
                                                        ?>
                                                        
                                                    </td>
                                                    <td>
                                                    <?php 
                                                        
                                                        
                                                       echo substr($row['service_description'],0,30)."...."; 
                                                     ?>
                                                         
                                                     </td>
                                                    
                                                    <td>
                                                        <div class="btn-group">

                                                            <?php if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 3) { ?>

                                                                <a href="service-view.php?id=<?php echo $row['id'];?>" class="btn text-purple"><i class="fa fa-eye"></i>
                                                                </a>
                                                            <?php } ?>

                                                            <?php if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 1) { ?>

                                                                <a href="service-edit.php?id=<?php echo $row['id'];?>" class="btn text-info"><i class="fa fa-edit"></i>
                                                                </a>

                                                            <?php } ?>

                                                            <?php if ($_SESSION['user_role'] == 1) { ?>
                                                                 <a href="service-restore.php?id=<?= $row['id'];?>" class="btn text-warning" onclick="return confirm('are you sure restore this service ?')">Restore</a>
                                                                <a href="service-delete.php?id=<?php echo $row['id'];?>" class="btn text-danger" onclick="return confirm('are your sure permanently delete this service ?')" title="permanently delete"><i class="fa fa-trash"></i>
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
                                                    <th>Service Icon</th>
                                                    <th>Service Title</th>
                                                    <th>Status</th>
                                                    <th>Service Description</th>
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
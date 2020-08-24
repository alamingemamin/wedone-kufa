<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";
  $sql   = "SELECT * FROM projects WHERE deleted='1' ORDER BY id DESC";
  $query = mysqli_query($connect,$sql);

$title = "projects list page";
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

                                          $trash_sql   = "SELECT * FROM projects WHERE deleted='0' ORDER BY id DESC";
                                          $trash_query = mysqli_query($connect,$trash_sql);
                                          $trash_count = mysqli_num_rows($trash_query);
                                           ?>
                                          <b class="float-left">projects Trash below here</b><a href="project-list.php" class="btn btn-success float-right"><span class="badge badge-danger badge-pill float-right"><?= $trash_count; ?></span><span> project List</span></a>
                                        </div>
                                        <div class="card-box text-white">
                                            <table class="table table-bordered  text-white table-sm text-center text-dark table-responsive-sm" id="table">
                                             <thead class="bg-custom text-white text-white">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>project Name</th>
                                                    <th>Status</th>
                                                    <th>project Description</th>
                                                    <th>project title</th>
                                                    <th>project photo</th>
                                                    <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody class="text-white">

                                                <?php
                                                 while ($row = mysqli_fetch_assoc($query)) { ?>

                                                 <tr id="table_tr">
                                                    <td><?= $row['id']; ?></td>


                                                    <td><?= $row['project_name']; ?></td>
                                                    <td>
                                                        <?php
                                                         if ($row['status'] == 1) { ?>
                                                            <a href="project-deactive.php?id=<?= $row['id']?>" class="btn" title="active"><i class="fas fa-toggle-on" style="font-size: 28px;"></i></a>
                                                         <?php }else { ?>
                                                           <a href="project-active.php?id=<?= $row['id']?>" class="btn text-secondary" title="deactive"><i class="fas fa-toggle-off" style="font-size: 28px;"></i></a>
                                                         <?php  } 
                                                        ?>
                                                        
                                                    </td>
                                                    <td>
                                                    <?php 
                                                        
                                                        
                                                       echo substr($row['project_description'],0,30)."...."; 
                                                     ?>
                                                         
                                                     </td>

                                                     <td><?= $row['project_title']; ?></td>

                                                     <td>
                                                       <img src="../../uploads/projects-photos/<?= $row['project_photo']?>" class="rounded-circle" style="width: 50px;height: 50px;">
                                                     </td>
                                                    
                                                    <td>
                                                        <div class="btn-group">



                                                            <?php if ($_SESSION['user_role'] == 1) { ?>
                                                               <a href="project-restore.php?id=<?php echo $row['id'];?>" class="btn text-warning" onclick="return confirm('are your sure move to trash this project ?')">Restore
                                                                </a>
                                                                <a href="project-delete.php?id=<?php echo $row['id'];?>" class="btn text-danger" onclick="return confirm('are your sure delete this project ?')"><i class="fa fa-trash"></i>
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
                                                    <th>project Name</th>
                                                    <th>Status</th>
                                                    <th>project Description</th>
                                                    <th>project title</th>
                                                    <th>project Photo</th>
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
<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";
  $sql   = "SELECT * FROM users WHERE deleted='1' ORDER BY id DESC";
  $query = mysqli_query($connect,$sql);

$title = "All users list page";
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
                                  
                                    <div class="text-white">
                                        <div class="card-header text-white clearfix" style="background: #112236"><b class="float-left">Trash users list below here</b><a href="all_users.php" class="btn btn-success float-right"> Back to all users</a></div>
                                        <div class="card-box text-white">
                                            <table class="table table-bordered  text-white table-sm text-center text-dark table-responsive-sm" id="table">
                                             <thead class="bg-custom text-white text-white">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Role</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody class="text-white">

                                                <?php
                                                 $i = 1;
                                                 while ($row = mysqli_fetch_assoc($query)) { ?>

                                                 <tr id="table_tr">
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $row['name']; ?></td>
                                                    <td><?= $row['gender']; ?></td>
                                                    <td>
                                                        <?php
                                                         if ($row['role'] == 1) {
                                                            echo "Admin";
                                                          }elseif ($row['role'] == 2) {
                                                            echo "Moderator";
                                                          }elseif ($row['role'] == 3) {
                                                            echo "Editor";
                                                          }else{
                                                            echo "Normal";
                                                          } 
                                                        ?>
                                                        
                                                    </td>
                                                    <td><?= $row['email']; ?></td>
                                                    <td>********</td>
                                                    <td>
                                                        <div class="">

                                                            <?php if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 3) { ?>

                                                                <a href="view.php?id=<?php echo $row['id'];?>" class="btn text-info"><i class="fa fa-eye"></i>
                                                                </a>
                                                            <?php } ?>

                                                            <?php if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 1) { ?>

                                                                <a href="edit.php?id=<?php echo $row['id'];?>" class="btn text-warning"><i class="fa fa-edit"></i>
                                                                </a>

                                                            <?php } ?>

                                                            <?php if ($_SESSION['user_role'] == 1) { ?>
                                                                <a href="restore.php?id=<?php echo $row['id'];?>" class="btn text-info">Restore
                                                                </a>
                                                                
                                                                <a href="delete.php?id=<?= $row['id'];?>" class="text-danger" title="permanently delete" onclick="return confirm('are you sure permanently delete this user ?')"><i class="fa fa-trash"></i></a>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                     
                                                <?php  } ?>
                                            </tbody>
                                            <tfoot class="bg-custom text-white">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Status</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
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
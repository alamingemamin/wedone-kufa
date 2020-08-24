<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";
  $sql   = "SELECT * FROM banner_icons WHERE deleted='1' ORDER BY id DESC";
  $query = mysqli_query($connect,$sql);

$title = "banner icons list page";
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
                                          
                                          $banner_icons_sql   = "SELECT * FROM banner_icons WHERE deleted='0' ORDER BY id DESC";
                                          $banner_icons_query = mysqli_query($connect,$banner_icons_sql);
                                          $banner_icons_count = mysqli_num_rows($banner_icons_query);

                                          ?>
                                           
                                          <b class="float-left">banner icons list below here</b><a href="banner-icons-list.php" class="btn btn-success float-right"><span class="badge badge-danger badge-pill float-right"><?= $banner_icons_count;?></span><span> Banner icons List </span></a>
                                        </div>
                                        <div class="card-box text-white">
                                            <table class="table table-bordered  text-white table-sm text-center text-dark table-responsive-sm" id="table">
                                             <thead class="bg-custom text-white text-white">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Banner icon name</th>
                                                    <th>Banner icon Color</th>
                                                    <th>banner icon link</th>
                                                    <th>Banner id</th>
                                                    <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody class="text-white">

                                                <?php
                                                 while ($row = mysqli_fetch_assoc($query)) { ?>

                                                 <tr id="table_tr">
                                                    <td><?= $row['id']; ?></td>


                                                    <td><?= $row['banner_icon_name']; ?>&nbsp  <i class="<?= $row['banner_icon_name'];?>" style="color:<?= $row['banner_icon_color'];?>;"></i></td>
                                                    
                                                    <td><?= $row['banner_icon_color']; ?></td>

                                                    <td><?= $row['banner_icon_link']; ?></td>

                                                     <td><?= $row['banner_id']; ?></td>
                                                    
                                                    <td>
                                                        <div class="btn-group">


                                                            <?php if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 1) { ?>

                                                                <a href="banner-icons-edit.php?id=<?php echo $row['id'];?>" class="btn text-info"><i class="fa fa-edit"></i>
                                                                </a>

                                                            <?php } ?>

                                                            <?php if ($_SESSION['user_role'] == 1) { ?>
                                                               <a href="banner-icons-restore.php?id=<?php echo $row['id'];?>" class="btn text-warning" onclick="return confirm('are your sure move to trash this banner icon ?')">Restore
                                                                </a>
                                                                <a href="banner-icons-delete.php?id=<?php echo $row['id'];?>" class="btn text-danger" onclick="return confirm('are your sure delete this banner icon ?')"><i class="fa fa-trash"></i>
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
                                                    <th>banner icon name</th>
                                                    <th>banner icon color</th>
                                                    <th>banner icon link</th>
                                                    <th>Banner id</th>
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
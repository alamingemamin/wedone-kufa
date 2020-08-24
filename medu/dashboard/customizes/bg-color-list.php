<?php session_start(); ?>

<?php include "../auth_check.php"; ?>

<?php 
  include "../../includes/database.php";


  // insert bg color frontend theme customize

  if (isset($_POST['bg-add'])) {
    $bg_theme       = $_POST['bg-theme'];
    $bg_header      = $_POST['bg-header'];
    $bg_sidebar     = $_POST['bg-sidebar'];
    $bg_banner      = $_POST['bg-banner'];
    $bg_about       = $_POST['bg-about'];
    $bg_service     = $_POST['bg-service'];
    $bg_portfolio   = $_POST['bg-portfolio'];
    $bg_fact        = $_POST['bg-fact'];
    $bg_testimonial = $_POST['bg-testimonial'];
    $bg_brand       = $_POST['bg-brand'];
    $bg_contact     = $_POST['bg-contact'];
    $bg_footer      = $_POST['bg-footer'];
    
    $bg_insert = "INSERT INTO customizes(bg_theme,
                                         bg_header,
                                         bg_sidebar,
                                         bg_banner,
                                         bg_about,
                                         bg_service,
                                         bg_portfolio,
                                         bg_fact,
                                         bg_testimonial,
                                         bg_brand,
                                         bg_contact,
                                         bg_footer,status)
                   VALUES('$bg_theme',
                          '$bg_header',
                          '$bg_sidebar',
                          '$bg_banner',
                          '$bg_about',
                          '$bg_service',
                          '$bg_portfolio',
                          '$bg_fact',
                          '$bg_testimonial',
                          '$bg_brand',
                          '$bg_contact',
                          '$bg_footer','0')";

    $bg_query = mysqli_query($connect,$bg_insert);

    if ($bg_query) {
      $_SESSION['success'] = "Bg color create successfully";

    }else{
      $_SESSION['error'] = "bg color not create sorry";

    }

  }

 

 // update bg color frontend theme cutomize

  if (isset($_POST['bg-update'])) {
    $update_id              = $_POST['id'];
    $update_bg_theme        = $_POST['bg-theme'];
    $update_bg_header       = $_POST['bg-header'];
    $update_bg_sidebar      = $_POST['bg-sidebar'];
    $update_bg_banner       = $_POST['bg-banner'];
    $update_bg_about        = $_POST['bg-about'];
    $update_bg_service      = $_POST['bg-service'];
    $update_bg_portfolio    = $_POST['bg-portfolio'];
    $update_bg_fact         = $_POST['bg-fact'];
    $update_bg_testimonial  = $_POST['bg-testimonial'];
    $update_bg_brand        = $_POST['bg-brand'];
    $update_bg_contact      = $_POST['bg-contact'];
    $update_bg_footer       = $_POST['bg-footer'];
    
    $bg_update = "UPDATE customizes SET bg_theme='$update_bg_theme',
                                        bg_header='$update_bg_header',
                                        bg_sidebar='$update_bg_sidebar',
                                        bg_banner='$update_bg_banner',
                                        bg_about='$update_bg_about',
                                        bg_service='$update_bg_service',
                                        bg_portfolio='$update_bg_portfolio',
                                        bg_fact='$update_bg_fact',
                                        bg_testimonial='$update_bg_testimonial',
                                        bg_brand='$update_bg_brand',
                                        bg_contact='$update_bg_contact',
                                        bg_footer='$update_bg_footer' WHERE id='$update_id'";

    $update_bg_query = mysqli_query($connect,$bg_update);

    if ($update_bg_query) {
      $_SESSION['success'] = "Bg color update successfully";

    }else{
      $_SESSION['error'] = "bg color not update sorry";

    }

  }

  $sql   = "SELECT * FROM customizes ORDER BY id DESC";
  $query = mysqli_query($connect,$sql);

$title = "customize list page";
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
                                           
                                          Cutomize bg color add
                                        </div>
                                        <div class="card-box text-white">
                                            <form action="" method="post" enctype="post">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="text-purple">Bg-theme :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-theme" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="text-purple">Bg-header :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-header" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="text-purple">Bg-sidebar :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-sidebar" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="text-purple">Bg-banner :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-banner" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="text-purple">Bg-portfolio :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-portfolio" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="text-purple">Bg-brand :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-brand" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="text-purple">Bg-about :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-about" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="text-purple">Bg-service :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-service" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="text-purple">Bg-fact :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-fact" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="text-purple">Bg-testimonial :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-testimonial" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="text-purple">Bg-contact :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-contact" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="text-purple">Bg-footer :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-peint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-footer" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <input type="submit" name="bg-add" value="Save bg color" class="btn btn-pink btn-sm">
                                                </div>
                                            </form>
                                        </div>
                                    </div>




                                   <!-- // show all bg color frontend theme cutomize -->
                                  
                                    <div class="text-white">
                                        <div class="card-header text-white clearfix" style="background: #112236">
                                           
                                          Cutomize list
                                        </div>
                                        <div class="card-box text-white">
                                            <table class="table table-bordered  text-white table-sm text-center text-dark table-responsive-sm" id="table">
                                             <thead class="bg-custom text-white text-white">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>bg-theme</th>
                                                    <th>bg-header</th>
                                                    <th>bg-footer</th>
                                                    <th>status</th>
                                                    <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody class="text-white">

                                                <?php
                                                $i = 1;
                                                 while ($row = mysqli_fetch_assoc($query)) { ?>

                                                 <tr id="table_tr" class=" <?= $row['status'] == 0 ? 'bg-light' : 'bg-white';?>">

                                                    <td class="text-dark"><?= $i++; ?></td>


                                                    <td style="color:<?= $row['bg_theme']; ?>"><?= $row['bg_theme'];?></td>
                                                    
                                                    <td style="color:<?= $row['bg_header']; ?>"><?= $row['bg_header'];?></td>
                                                    

                                                    <td style="color:<?= $row['bg_sidebar']; ?>"><?= $row['bg_sidebar'];?></td>
                                                    
                                                    <td class=""><?php 
                                                    
                                                    if ($row['status'] == 0) {  ?>
                                                      <a href="bg-color-active.php?id=<?= $row['id']; ?>" class="btn text-warning"><i class="fas fa-toggle-off" style="font-size: 28px;"></i></a>
                                                    <?php }else{  ?>
                                                       <a href="bg-color-deactive.php?id=<?= $row['id']; ?>" class="btn text-success"><i class="fas fa-toggle-on" style="font-size: 28px;"></i></a>
                                                    <?php  }


                                                    ?></td>
                                                    
                                                    
                                                    <td>
                                                        <div class="btn-group">

                                                            <?php if ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 1) { ?>

                                                                <!-- Button trigger modal -->
                                                          <a  class="btn text-custom" data-toggle="modal" data-target="#editModal<?= $row['id'];?>">
                                                            <i class="fas fa-edit"></i>
                                                          </a>

                                                          <!-- Modal -->
                                                          <div class="modal fade" id="editModal<?= $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                              <div class="modal-content">
                                                                <div class="modal-header" style="background: #112233;">
                                                                  <h5 class="modal-title" id="exampleModalLongTitle">bg color edit</h5>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                                </div>
                                                                
                                                                  <div class="card-box text-white">
                                            <form action="" method="post" enctype="post">
                                              <input type="hidden" name="id" value="<?= $row['id']; ?>" >
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="text-purple text-left">Bg-theme :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-theme" class="form-control form-control-sm" value="<?= $row['bg_theme']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="text-purple text-left">Bg-header :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-header" class="form-control form-control-sm" value="<?= $row['bg_header']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="text-purple text-left">Bg-sidebar :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-sidebar" class="form-control form-control-sm" value="<?= $row['bg_sidebar']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </div>

                                                  <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="text-purple text-left">Bg-banner :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-banner" class="form-control form-control-sm" value="<?= $row['bg_banner']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="text-purple text-left">Bg-portfolio :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-portfolio" class="form-control form-control-sm" value="<?= $row['bg_portfolio']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="text-purple text-left">Bg-brand :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-brand" class="form-control form-control-sm" value="<?= $row['bg_brand']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="text-purple text-left">Bg-about :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-about" class="form-control form-control-sm" value="<?= $row['bg_about']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="text-purple text-left">Bg-service :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-service" class="form-control form-control-sm" value="<?= $row['bg_service']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="text-purple text-left">Bg-fact :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-fact" class="form-control form-control-sm" value="<?= $row['bg_fact']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </div>

                                                 
                                                  <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="text-purple text-left">Bg-testimonial :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-testimonial" class="form-control form-control-sm" value="<?= $row['bg_testimonial']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="text-purple text-left">Bg-contact :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-paint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-contact" class="form-control form-control-sm" value="<?= $row['bg_contact']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="text-purple text-left">Bg-footer :</label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-peint"></i></span>
                                                                </div>
                                                                <input type="color" name="bg-footer" class="form-control form-control-sm" value="<?= $row['bg_footer']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <input type="submit" name="bg-update" value="Save bg color" class="btn btn-pink btn-sm">
                                                </div>
                                            </form>
                                        </div>
                                                                
                                                                <div class="modal-footer " style="background: #112233;">
                                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>

                                                            <?php } ?>

                                                            <?php if ($_SESSION['user_role'] == 1) { ?>
                                                                <a href="bg-color-delete.php?id=<?php echo $row['id'];?>" class="btn text-danger" onclick="return confirm('are your sure delete bg color ?')"><i class="fa fa-trash"></i>
                                                                </a>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                     
                                                <?php } ?>
                                            </tbody>
                                            <tfoot class="bg-custom text-white">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>bg-theme</th>
                                                    <th>bg-header</th>
                                                    <th>bg-footer</th>
                                                    <th>status</th>
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
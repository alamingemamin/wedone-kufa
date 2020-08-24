        <?php  session_start();  ?>

              <?php include "../auth_check.php"; ?>
              
              <?php

              require "../../includes/database.php";  
              if (isset($_POST['add-fact'])) {
                $fact_icon            = mysqli_real_escape_string($connect,trim($_POST['fact_icon']));
                $fact_title           = mysqli_real_escape_string($connect,trim($_POST['fact_title']));
                $fact_count           = mysqli_real_escape_string($connect,trim($_POST['fact_count']));
                $fact_icon_color      = $_POST['fact_icon_color'];
                
                if (empty($fact_icon)) {
                  $_SESSION['error'] = "fact icon is required";

                }elseif (empty($fact_title)) {
                  $_SESSION['error'] = "fact Title is required";

                }elseif (empty($fact_count)) {
                  $_SESSION['error'] = "fact count is required";

                }elseif (is_numeric($fact_icon)) {
                  $_SESSION['error'] = "fact icon must be use alphabatic character";

                }elseif (is_numeric($fact_title)) {
                  $_SESSION['error'] = "fact title must be use alphabatic character";

                }else{
                  $select_sql   = "SELECT * FROM facts WHERE fact_title='$fact_title'";
                  $select_query = mysqli_query($connect,$select_sql);
                  $count_row    = mysqli_num_rows($select_query);

                  if ($count_row >= 1) {
                    $_SESSION['error'] = "fact title is already exists ! please try to anther email";

                  }else{
                    $insert_sql = "INSERT INTO facts(fact_icon,fact_icon_color,fact_title,fact_count,status) VALUES ('$fact_icon','$fact_icon_color','$fact_title','$fact_count','0')";
                    $insert_query = mysqli_query($connect,$insert_sql);

                    if ($insert_query) {
                       $_SESSION['success'] = "fact insert has been successfully complated";
                       header("location: fact-list.php");

                    }else{
                      $_SESSION['error'] = "Ooops !!, fact does not insert.please try again";

                    }
                  }
                }
                
            }

          $title = "fact create page";

          ?>

        <?php require "../../includes/layouts/header.php"; ?>
     

           <?php  if (isset($_SESSION['error'])): ?>


            <script type="text/javascript">
              Swal.fire({
                icon: 'error',
                html:'<p><b class="text-danger"><i class="fa fa-warning"></i></b>&nbsp&nbsp&nbsp<span class="text-warning"><?php echo $_SESSION['error']; ?></span></p>',
              })
            </script>

           <?php endif; unset($_SESSION['error']); ?>

           

           <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                
                                  
                                  <div class="">
                                      <div class="card-header bg-success text-white clearfix"><b class="float-left">Add New fact</b><a href="fact-list.php" class="btn btn-warning float-right">Back to fact list</a></div>
                                            <div class="card-box">
                                             <form action="" method="post">

                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="icon" class="text-white">fact icon</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-photo"></i></span>
                                                        </div>
                                                        <input type="text" name="fact_icon" class="form-control" id="fact_icon"  placeholder="fa fa-example" value="<?php if(isset($_POST['fact_icon'])){echo $_POST['fact_icon']; } ?>">
                                                      </div> 
                                                    </div>
                                                  </div>

                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="title" class="text-white">fact Title</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fa fa-fact"></i></span>
                                                        </div>
                                                        <input type="text" name="fact_title" class="form-control" id="fact_title"  placeholder="fact title" value="<?php if(isset($_POST['fact_title'])){echo $_POST['fact_title']; } ?>">
                                                      </div> 
                                                    </div>
                                                  </div>
                                                </div>


                                                  <div class="form-group">
                                                      <label for="title" class="text-white">fact Icon color</label>
                                                      <div class="input-group">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text"><i class="fas fa-palette"></i></span>
                                                        </div>
                                                        <input type="color" name="fact_icon_color" class="form-control" id="fact_icon_color"  placeholder="fact icon color" value="<?php if(isset($_POST['fact_icon_color'])){echo $_POST['fact_icon_color']; } ?>">
                                                      </div> 
                                                  </div>

                                                <div class="form-group">
                                                  <label class="text-white">fact count</label>
                                                  <div class="input-group">
                                                    <div class="input-group-append">
                                                      <span class="input-group-text"><i class="fa fa-male"></i></span>
                                                    </div>
                                                    <input type="number" name="fact_count" id="fact_count" class="form-control" value="<?php 
                                                   if (isset($_POST['fact_count'])) {
                                                      echo $_POST['fact_count'];
                                                    } ?>">
                                                  </div>
                                                </div>
               
                                
                                                <div class="form-group">
                                                  <button type="submit" name="add-fact" class="btn btn-pink w-50">Add fact </button>
                                                </div>
                                              </form>
                                         </div>
                                      
                                       </div>
                                     </div>
                                   </div>

                               
                            </div>
                        </div> 
                    </div> <!-- container -->
                </div> <!-- content -->

           
    

    <?php require "../../includes/layouts/footer.php"; ?>
<?php session_start(); ?>
<?php 

 if (isset($_COOKIE['username'])) {
       $cookie_value = $_COOKIE['username'];
    }else{
      
      header("location: ../../index.php");
   }

                                   
include "../auth_check.php"; 

include "../../includes/database.php";

$title = "Admin  Dashboard";
?>
<?php require "../../includes/layouts/header.php"; ?>
            <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row mb-0">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card-box" style="margin-bottom: -17px !important;"> 

                                    


                                        <?php if(isset($_SESSION['success'])): ?>
                                            <script type="text/javascript">
                                              Swal.fire({
                                                icon: 'success',
                                                html:'<p><b class="success"><i class="fa fa-ok"></i></b>&nbsp&nbsp&nbsp<span class="text-success"><?php echo $_SESSION['success']; ?></span></p>',
                                              })
                                            </script>

                                        <?php endif; unset($_SESSION['success']);  ?>


                                 <div class="d-flex justify-content-between">
                                    <h5 class="float-left">Welcome <b class="text-success"><?php echo ucwords($_SESSION['user_name']); ?></b>
                                    </h5>

                                    <h5 class="float-right">Your email is : <b class="text-success"><?php echo $_SESSION['user_email']; ?></b>
                                    </h5>
                                 </div>
                                
                              </div>
                            </div>
                        </div>


                        <div class="row mt-0">
                          <div class="col-lg-4 col-md-4 col-sm-6" >
                            <div class="">
                              <!-- user information here -->
                              <?php 
                              // all users count from users table
                              $select_all_user = "SELECT * FROM users";
                              $all_user_query  = mysqli_query($connect,$select_all_user);
                              $count_all_user  = mysqli_num_rows($all_user_query);

                              //admin users count from users table
                              $select_admin_user = "SELECT * FROM users WHERE role='1'";
                              $admin_user_query  = mysqli_query($connect,$select_admin_user);
                              $count_admin_user  = mysqli_num_rows($admin_user_query);

                              //motivator users count from users table 
                              $select_motivator_user = "SELECT * FROM users WHERE role='2'";
                              $motivator_user_query  = mysqli_query($connect,$select_motivator_user);
                              $count_motivator_user  = mysqli_num_rows($motivator_user_query);

                              //trash users count from users table
                              $select_trash_user = "SELECT * FROM users WHERE deleted='1'";
                              $trash_user_query  = mysqli_query($connect,$select_trash_user);
                              $count_trash_user  = mysqli_num_rows($trash_user_query);

                              ?>
                             


                              <div class="media p-1 rounded" style="background: #112230;">
                                <p class="mr-2 pt-2" style="background:#112233;"><i class="fas fa-user text-success" style="font-size:120px; height: 100px;"></i>
                                </p>
                                <div class="media-body">
                                  <div class="d-flex justify-content-between">
                                      <p><a href="all_users.php">All Users</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_all_user; ?></b></p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="all_users.php">Admin Users</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_admin_user; ?></b></p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="all_users.php">Motivator Users</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_motivator_user; ?></b></p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="user-trash.php">Trash Users</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_trash_user; ?></b></p>
                                  </div>

                                </div>
                              </div>
                          </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6" >
                            <div class="">
                              <!-- user information here -->
                              <?php 
                              // all service count from services table
                              $select_all_service = "SELECT * FROM services";
                              $all_service_query  = mysqli_query($connect,$select_all_service);
                              $count_all_service  = mysqli_num_rows($all_service_query);

                              //active service count from services table
                              $select_active_service = "SELECT * FROM services WHERE status='1'";
                              $active_service_query  = mysqli_query($connect,$select_active_service);
                              $count_active_service  = mysqli_num_rows($active_service_query);

                              //deactive service count from services table
                              $select_deactive_service = "SELECT * FROM services WHERE status='0'";
                              $deactive_service_query  = mysqli_query($connect,$select_deactive_service);
                              $count_deactive_service  = mysqli_num_rows($deactive_service_query);

                              //trash service count form services table
                              $select_trash_service = "SELECT * FROM services WHERE deleted='1'";
                              $trash_service_query  = mysqli_query($connect,$select_trash_service);
                              $count_trash_service  = mysqli_num_rows($trash_service_query);

                              ?>
                             


                              <div class="media p-1 rounded" style="background: #112230;">
                                <p class="mr-2 pt-2" style="background:#112233;"><i class="fas fa-stream text-success" style="font-size:120px; height: 100px;"></i>
                                </p>
                                <div class="media-body">
                                  <div class="d-flex justify-content-between">
                                      <p><a href="../services/service-list.php">All Services</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_all_service; ?></b></p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../services/service-list.php">Active Service</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_active_service; ?></b></p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../services/service-list.php">Deactive services</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_deactive_service; ?></b></p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../services/service-trash-list.php">Trash Services</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_trash_service; ?></b></p>
                                  </div>

                                </div>
                              </div>
                          </div>
                        </div>
                        


                        <div class="col-lg-4 col-md-4 col-sm-6" >
                            <div class="">
                              <!-- user information here -->
                              <?php 
                              // all project count from projects table
                              $select_all_project = "SELECT * FROM projects";
                              $all_project_query  = mysqli_query($connect,$select_all_project);
                              $count_all_project  = mysqli_num_rows($all_project_query);

                              //active project count from projects table
                              $select_active_project = "SELECT * FROM projects WHERE status='1'";
                              $active_project_query  = mysqli_query($connect,$select_active_project);
                              $count_active_project  = mysqli_num_rows($active_project_query);

                              //deactive project count from projects table
                              $select_deactive_project = "SELECT * FROM projects WHERE status='0'";
                              $deactive_project_query  = mysqli_query($connect,$select_deactive_project);
                              $count_deactive_project  = mysqli_num_rows($deactive_project_query);

                              //trash project count form projects table
                              $select_trash_project = "SELECT * FROM projects WHERE deleted='1'";
                              $trash_project_query  = mysqli_query($connect,$select_trash_project);
                              $count_trash_project  = mysqli_num_rows($trash_project_query);

                              ?>
                             


                              <div class="media p-1 rounded" style="background: #112230;">
                                <p class="mr-2 pt-2" style="background:#112233;"><i class="fas fa-project-diagram text-success" style="font-size:120px; height: 100px;"></i>
                                </p>
                                <div class="media-body">
                                  <div class="d-flex justify-content-between">
                                      <p><a href="../projects/project-list.php">All project</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_all_project; ?></b></p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../projects/project-list.php">Active project</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_active_project; ?></b></p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../projects/project-list.php">Deactive project</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_deactive_project; ?></b></p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../projects/project-trash-list.php">Trash project</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_trash_project; ?></b></p>
                                  </div>

                                </div>
                              </div>
                          </div>
                        </div>




                        <div class="col-lg-4 col-md-4 col-sm-6" >
                            <div class="">
                              <!-- facts information here -->
                              <?php 
                              // all fact count from facts table
                              $select_all_fact = "SELECT * FROM projects";
                              $all_fact_query  = mysqli_query($connect,$select_all_fact);
                              $count_all_fact  = mysqli_num_rows($all_fact_query);

                              //active fact count from facts table
                              $select_active_fact = "SELECT * FROM projects WHERE status='1'";
                              $active_fact_query  = mysqli_query($connect,$select_active_fact);
                              $count_active_fact  = mysqli_num_rows($active_fact_query);

                              //deactive fact count from facts table
                              $select_deactive_fact = "SELECT * FROM projects WHERE status='0'";
                              $deactive_fact_query  = mysqli_query($connect,$select_deactive_fact);
                              $count_deactive_fact  = mysqli_num_rows($deactive_fact_query);

                              //trash fact count form facts table
                              $select_trash_fact = "SELECT * FROM projects WHERE deleted='1'";
                              $trash_fact_query  = mysqli_query($connect,$select_trash_fact);
                              $count_trash_fact  = mysqli_num_rows($trash_fact_query);

                              ?>
                             


                              <div class="media p-1 rounded" style="background: #112230;">
                                <p class="mr-2 pt-2" style="background:#112233;"><i class="fas fa-industry-alt text-success" style="font-size:120px; height: 100px;"></i>
                                </p>
                                <div class="media-body">
                                  <div class="d-flex justify-content-between">
                                      <p><a href="../facts/fact-list.php">All fact</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_all_fact; ?></b></p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../facts/fact-list.php">Active fact</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_active_fact; ?></b></p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../facts/fact-list.php">Deactive fact</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_deactive_fact; ?></b></p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../facts/fact-trash-list.php">Trash fact</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_trash_fact; ?></b></p>
                                  </div>

                                </div>
                              </div>
                          </div>
                        </div>


                        <div class="col-lg-4 col-md-4 col-sm-6" >
                            <div class="">
                              <!-- Brand-logo information here -->
                              <?php 
                              // all brand_logo count from brands_logo table
                              $select_all_brand_logo = "SELECT * FROM brands_logo";
                              $all_brand_logo_query  = mysqli_query($connect,$select_all_brand_logo);
                              $count_all_brand_logo  = mysqli_num_rows($all_brand_logo_query);

                              //active brand_logo count from brands_logo table
                              $select_active_brand_logo = "SELECT * FROM brands_logo WHERE status='1'";
                              $active_brand_logo_query  = mysqli_query($connect,$select_active_brand_logo);
                              $count_active_brand_logo  = mysqli_num_rows($active_brand_logo_query);

                              //deactive brand_logo count from brands_logo table
                              $select_deactive_brand_logo = "SELECT * FROM brands_logo WHERE status='0'";
                              $deactive_brand_logo_query  = mysqli_query($connect,
                                                                         $select_deactive_brand_logo);
                              $count_deactive_brand_logo  = mysqli_num_rows($deactive_brand_logo_query);

                              //trash brand_logo count form brands_logo table
                              $select_trash_brand_logo = "SELECT * FROM brands_logo WHERE deleted='1'";
                              $trash_brand_logo_query  = mysqli_query($connect,$select_trash_brand_logo);
                              $count_trash_brand_logo  = mysqli_num_rows($trash_brand_logo_query);

                              ?>
                             


                              <div class="media p-1 rounded" style="background: #112230;">
                                <p class="mr-2 pt-2" style="background:#112233;"><i class="fab fa-accusoft text-success" style="font-size:120px; height: 100px;"></i>
                                </p>
                                <div class="media-body">
                                  <div class="d-flex justify-content-between">
                                      <p><a href="../brands-logos/brands-logos-list.php">All brand-logo</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_all_brand_logo; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../brands-logos/brands-logos-list.php">Active brand-logo</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_active_brand_logo; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../brands-logos/brands-logos-list.php">Deactive brand-logo</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_deactive_brand_logo; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../brands-logos/brands-logos-trash-list.php">Trash brand-logo</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_trash_brand_logo; ?></b>
                                      </p>
                                  </div>

                                </div>
                              </div>
                          </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6" >
                            <div class="">
                              <!-- Banner information here -->
                              <?php 
                              // all banner count from banners table
                              $select_all_banner = "SELECT * FROM banners";
                              $all_banner_query  = mysqli_query($connect,$select_all_banner);
                              $count_all_banner  = mysqli_num_rows($all_banner_query);

                              //active banner count from banners table
                              $select_active_banner = "SELECT * FROM banners WHERE status='1'";
                              $active_banner_query  = mysqli_query($connect,$select_active_banner);
                              $count_active_banner  = mysqli_num_rows($active_banner_query);

                              //deactive banner count from banners table
                              $select_deactive_banner = "SELECT * FROM banners WHERE status='0'";
                              $deactive_banner_query  = mysqli_query($connect,$select_deactive_banner);
                              $count_deactive_banner  = mysqli_num_rows($deactive_banner_query);

                              //trash banner count form banner table
                              $select_trash_banner = "SELECT * FROM banners WHERE deleted='1'";
                              $trash_banner_query  = mysqli_query($connect,$select_trash_banner);
                              $count_trash_banner  = mysqli_num_rows($trash_banner_query);

                              ?>
                             


                              <div class="media p-1 rounded" style="background: #112230;">
                                <p class="mr-2 pt-2" style="background:#112233;"><i class="fas fa-chalkboard text-success" style="font-size:120px; height: 100px;"></i>
                                </p>
                                <div class="media-body">
                                  <div class="d-flex justify-content-between">
                                      <p><a href="../banners/banner-list.php">All banners</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_all_banner; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../banners/banner-list.php">Active banner</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_active_banner; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../banners/banner-list.php">Deactive banner</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_deactive_banner; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../banners/banner-trash-list.php">Trash banner</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_trash_banner; ?></b>
                                      </p>
                                  </div>

                                </div>
                              </div>
                          </div>
                        </div>
                          


                        <div class="col-lg-4 col-md-4 col-sm-6" >
                            <div class="">
                              <!-- client information here -->
                              <?php 
                              // all clinet count from clinets table
                              $select_all_client = "SELECT * FROM clients";
                              $all_client_query  = mysqli_query($connect,$select_all_client);
                              $count_all_client  = mysqli_num_rows($all_client_query);

                              //active client count from clients table
                              $select_active_client = "SELECT * FROM clients WHERE status='1'";
                              $active_client_query  = mysqli_query($connect,$select_active_client);
                              $count_active_client  = mysqli_num_rows($active_client_query);

                              //deactive client count from clients table
                              $select_deactive_client = "SELECT * FROM clients WHERE status='0'";
                              $deactive_client_query  = mysqli_query($connect,$select_deactive_client);
                              $count_deactive_client  = mysqli_num_rows($deactive_client_query);

                              //trash client count form clients table
                              $select_trash_client = "SELECT * FROM clients WHERE deleted='1'";
                              $trash_client_query  = mysqli_query($connect,$select_trash_client);
                              $count_trash_client  = mysqli_num_rows($trash_client_query);

                              ?>
                             


                              <div class="media p-1 rounded" style="background: #112230;">
                                <p class="mr-2 pt-2" style="background:#112233;"><i class="fas fa-headset text-success" style="font-size:120px; height: 100px;"></i>
                                </p>
                                <div class="media-body">
                                  <div class="d-flex justify-content-between">
                                      <p><a href="../clients/client-list.php">All clients</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_all_client; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../clients/client-list.php">Active client</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_active_client; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../clients/client-list.php">Deactive Client</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_deactive_client; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../clients/client-trash-list.php">Trash client</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_trash_client; ?></b>
                                      </p>
                                  </div>

                                </div>
                              </div>
                          </div>
                        </div>
                        
                        

                        <div class="col-lg-4 col-md-4 col-sm-6" >
                            <div class="">
                              <!-- education information here -->
                              <?php 
                              // all education count from educations table
                              $select_all_education = "SELECT * FROM educations";
                              $all_education_query  = mysqli_query($connect,$select_all_education);
                              $count_all_education  = mysqli_num_rows($all_education_query);

                              //active education count from educations table
                              $select_active_education = "SELECT * FROM educations WHERE status='1'";
                              $active_education_query  = mysqli_query($connect,$select_active_education);
                              $count_active_education  = mysqli_num_rows($active_education_query);

                              //deactive education count from educations table
                              $select_deactive_education = "SELECT * FROM educations WHERE status='0'";
                              $deactive_education_query  = mysqli_query($connect,$select_deactive_education);
                              $count_deactive_education  = mysqli_num_rows($deactive_education_query);

                              //trash education count form educations table
                              $select_trash_education = "SELECT * FROM educations WHERE deleted='1'";
                              $trash_education_query  = mysqli_query($connect,$select_trash_education);
                              $count_trash_education  = mysqli_num_rows($trash_education_query);

                              ?>
                             


                              <div class="media p-1 rounded" style="background: #112230;">
                                <p class="mr-2 pt-2" style="background:#112233;"><i class="fas fa-user-graduate text-success" style="font-size:120px; height: 100px;"></i>
                                </p>
                                <div class="media-body">
                                  <div class="d-flex justify-content-between">
                                      <p><a href="../educations/education-list.php">All education</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_all_education; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../educations/education-list.php">Active education</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_active_education; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../educations/education-list.php">Deactive education</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_deactive_education; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../educations/education-trash-list.php">Trash education</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_trash_education; ?></b>
                                      </p>
                                  </div>

                                </div>
                              </div>
                          </div>
                        </div>


                        
                        <div class="col-lg-4 col-md-4 col-sm-6" >
                            <div class="">
                              <!-- abouts information here -->
                              <?php 
                              // all about count from abouts table
                              $select_all_about = "SELECT * FROM abouts";
                              $all_about_query  = mysqli_query($connect,$select_all_about);
                              $count_all_about  = mysqli_num_rows($all_about_query);

                              //active about count from abouts table
                              $select_active_about = "SELECT * FROM abouts WHERE status='1'";
                              $active_about_query  = mysqli_query($connect,$select_active_about);
                              $count_active_about  = mysqli_num_rows($active_about_query);

                              //deactive about count from abouts table
                              $select_deactive_about = "SELECT * FROM abouts WHERE status='0'";
                              $deactive_about_query  = mysqli_query($connect,$select_deactive_about);
                              $count_deactive_about  = mysqli_num_rows($deactive_about_query);

                              //trash about count form abouts table
                              $select_trash_about = "SELECT * FROM abouts WHERE deleted='1'";
                              $trash_about_query  = mysqli_query($connect,$select_trash_about);
                              $count_trash_about  = mysqli_num_rows($trash_about_query);

                              ?>
                             


                              <div class="media p-1 rounded" style="background: #112230;">
                                <p class="mr-2 pt-2" style="background:#112233;"><i class="fab fa-audible text-success" style="font-size:120px; height: 100px;"></i>
                                </p>
                                <div class="media-body">
                                  <div class="d-flex justify-content-between">
                                      <p><a href="../abouts/about-list.php">All abouts</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_all_about; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../abouts/about-list.php">Active about</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_active_about; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../abouts/about-list.php">Deactive about</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_deactive_about; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../abouts/about-trash-list.php">Trash about</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_trash_about; ?></b>
                                      </p>
                                  </div>

                                </div>
                              </div>
                          </div>
                        </div>


                        <div class="col-lg-4 col-md-4 col-sm-6" >
                            <div class="">
                              <!-- contact information here -->
                              <?php 
                              // all contact count from contacts table
                              $select_all_contact = "SELECT * FROM contacts";
                              $all_contact_query  = mysqli_query($connect,$select_all_contact);
                              $count_all_contact  = mysqli_num_rows($all_contact_query);

                              //active contact count from contacts table
                              $select_active_contact = "SELECT * FROM contacts WHERE status='1'";
                              $active_contact_query  = mysqli_query($connect,$select_active_contact);
                              $count_active_contact  = mysqli_num_rows($active_contact_query);

                              //deactive contact count from contacts table
                              $select_deactive_contact = "SELECT * FROM contacts WHERE status='0'";
                              $deactive_contact_query  = mysqli_query($connect,$select_deactive_contact);
                              $count_deactive_contact  = mysqli_num_rows($deactive_contact_query);

                              //trash contact count form contacts table
                              $select_trash_contact = "SELECT * FROM contacts WHERE deleted='1'";
                              $trash_contact_query  = mysqli_query($connect,$select_trash_contact);
                              $count_trash_contact  = mysqli_num_rows($trash_contact_query);

                              ?>
                             


                              <div class="media p-1 rounded" style="background: #112230;">
                                <p class="mr-2 pt-2" style="background:#112233;"><i class="fas fa-phone-office text-success" style="font-size:120px; height: 100px;"></i>
                                </p>
                                <div class="media-body">
                                  <div class="d-flex justify-content-between">
                                      <p><a href="../contacts/contact-list.php">All contacts</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_all_contact; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../contacts/contact-list.php">Active contact</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_active_contact; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../contacts/contact-list.php">Deactive contact</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_deactive_contact; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../contacts/contact-trash-list.php">Trash contact</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_trash_contact; ?></b>
                                      </p>
                                  </div>

                                </div>
                              </div>
                          </div>
                        </div>


                        <div class="col-lg-4 col-md-4 col-sm-6" >
                            <div class="">
                              <!-- logos information here -->
                              <?php 
                              // all logos count from logos table
                              $select_all_logos = "SELECT * FROM logos";
                              $all_logos_query  = mysqli_query($connect,$select_all_logos);
                              $count_all_logos  = mysqli_num_rows($all_logos_query);

                              //active logos count from logos table
                              $select_active_logos = "SELECT * FROM logos WHERE status='1'";
                              $active_logos_query  = mysqli_query($connect,$select_active_logos);
                              $count_active_logos  = mysqli_num_rows($active_logos_query);

                              //deactive logos count from logos table
                              $select_deactive_logos = "SELECT * FROM logos WHERE status='0'";
                              $deactive_logos_query  = mysqli_query($connect,$select_deactive_logos);
                              $count_deactive_logos  = mysqli_num_rows($deactive_logos_query);

                              //trash  count form logos table
                              $select_trash_logos = "SELECT * FROM logos WHERE deleted='1'";
                              $trash_logos_query  = mysqli_query($connect,$select_trash_logos);
                              $count_trash_logos  = mysqli_num_rows($trash_logos_query);

                              ?>
                             


                              <div class="media p-1 rounded" style="background: #112230;">
                                <p class="mr-2 pt-2" style="background:#112233;"><i class="fab fa-affiliatetheme text-success" style="font-size:120px; height: 100px;"></i>
                                </p>
                                <div class="media-body">
                                  <div class="d-flex justify-content-between">
                                      <p><a href="../logos/logos-list.php">All logos</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_all_logos; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../logos/logos-list.php">Active logos</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_active_logos; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../logos/logos-list.php">Deactive logos</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_deactive_logos; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../logos/logos-trash-list.php">Trash logos</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_trash_logos; ?></b>
                                      </p>
                                  </div>

                                </div>
                              </div>
                          </div>
                        </div>
                        
                        
                        <div class="col-lg-4 col-md-4 col-sm-6" >
                            <div class="">
                              <!-- photos information here -->
                              <?php 
                              // all photo count from photos table
                              $select_all_photo = "SELECT * FROM photos";
                              $all_photo_query  = mysqli_query($connect,$select_all_photo);
                              $count_all_photo  = mysqli_num_rows($all_photo_query);

                              //active photo count from photos table
                              $select_active_photo = "SELECT * FROM photos WHERE status='1'";
                              $active_photo_query  = mysqli_query($connect,$select_active_photo);
                              $count_active_photo  = mysqli_num_rows($active_photo_query);

                              //deactive photo count from photos table
                              $select_deactive_photo = "SELECT * FROM photos WHERE status='0'";
                              $deactive_photo_query  = mysqli_query($connect,$select_deactive_photo);
                              $count_deactive_photo  = mysqli_num_rows($deactive_photo_query);

                              //trash photo count form photos table
                              $select_trash_photo = "SELECT * FROM photos WHERE deleted='1'";
                              $trash_photo_query  = mysqli_query($connect,$select_trash_photo);
                              $count_trash_photo  = mysqli_num_rows($trash_photo_query);

                              ?>
                             


                              <div class="media p-1 rounded" style="background: #112230;">
                                <p class="mr-2 pt-2" style="background:#112233;"><i class="fas fa-images text-success" style="font-size:120px; height: 100px;"></i>
                                </p>
                                <div class="media-body">
                                  <div class="d-flex justify-content-between">
                                      <p><a href="../photos/photo-list.php">All photo</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_all_photo; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../photos/photo-list.php">Active photo</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_active_photo; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../photos/photo-list.php">Deactive photo</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_deactive_photo; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../photos/photo-trash-list.php">Trash photo</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_trash_photo; ?></b>
                                      </p>
                                  </div>

                                </div>
                              </div>
                          </div>
                        </div>
                        

                        <div class="col-lg-4 col-md-4 col-sm-6" >
                            <div class="">
                              <!-- guest information here -->
                              <?php 
                              // all guest count from guest table
                              $select_all_guest = "SELECT * FROM guests";
                              $all_guest_query  = mysqli_query($connect,$select_all_guest);
                              $count_all_guest  = mysqli_num_rows($all_guest_query);

                              //active guest count from guests table
                              $select_active_guest = "SELECT * FROM guests WHERE status='1'";
                              $active_guest_query  = mysqli_query($connect,$select_active_guest);
                              $count_active_guest  = mysqli_num_rows($active_guest_query);

                              //deactive guest count from guests table
                              $select_deactive_guest = "SELECT * FROM guests WHERE status='0'";
                              $deactive_guest_query  = mysqli_query($connect,$select_deactive_guest);
                              $count_deactive_guest  = mysqli_num_rows($deactive_guest_query);

                              //trash guest count form guests table
                              $select_trash_guest = "SELECT * FROM guests WHERE deleted='1'";
                              $trash_guest_query  = mysqli_query($connect,$select_trash_guest);
                              $count_trash_guest  = mysqli_num_rows($trash_guest_query);

                              ?>
                             


                              <div class="media p-1 rounded" style="background: #112230;">
                                <p class="mr-2 pt-2" style="background:#112233;"><i class="fas fa-images text-success" style="font-size:120px; height: 100px;"></i>
                                </p>
                                <div class="media-body">
                                  <div class="d-flex justify-content-between">
                                      <p><a href="../guests/guest-list.php">All guest</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_all_guest; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../guests/guest-list.php">Active guest</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_active_guest; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../guests/guest-list.php">Deactive guest</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_deactive_guest; ?></b>
                                      </p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../guests/guest-trash-list.php">Trash guest</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_trash_guest; ?></b>
                                      </p>
                                  </div>

                                </div>
                              </div>
                          </div>
                        </div>



                        <div class="col-lg-4 col-md-4 col-sm-6" >
                            <div class="">
                              <!-- banner_icons information here -->
                              <?php 
                              // all banner_icons  count from banner_icons  table
                              $select_all_banner_icons  = "SELECT * FROM banner_icons ";
                              $all_banner_icons_query  = mysqli_query($connect,$select_all_banner_icons);
                              $count_all_banner_icons  = mysqli_num_rows($all_banner_icons_query);

                              //trash banner_icons count from banner_icons table
                              $select_trash_banner_icons = "SELECT * FROM banner_icons WHERE deleted='1'";
                              $trash_banner_icons_query  = mysqli_query($connect,$select_trash_banner_icons);
                              $count_trash_banner_icons  = mysqli_num_rows($trash_banner_icons_query);

                              ?>
                             


                              <div class="media p-1 rounded" style="background: #112230;">
                                <p class="mr-2 pt-2" style="background:#112233;"><i class="fas fa-user text-success" style="font-size:120px; height: 100px;"></i>
                                </p>
                                <div class="media-body">
                                  <div class="d-flex justify-content-between">
                                      <p><a href="../banner_icons/banner-icons-list.php">All banner_icons</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_all_banner_icons; ?></b></p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../banner_icons/banner-icons-trash-list.php">Trash banner_icons</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_trash_banner_icons; ?></b></p>
                                  </div>

                                </div>
                              </div>
                          </div>
                          </div>

                          <div class="col-lg-4 col-md-4 col-sm-6" >
                            <div class="">
                              <!-- customizes information here -->
                              <?php 
                              // all customizes  count from customizes  table
                              $select_all_customizes  = "SELECT * FROM customizes";
                              $all_customizes_query  = mysqli_query($connect,$select_all_customizes);
                              $count_all_customizes   = mysqli_num_rows($all_customizes_query);

                              //active customizes count from customizes table
                              $select_active_customizes = "SELECT * FROM customizes WHERE status='1'";
                              $active_customizes_query  = mysqli_query($connect,$select_active_customizes);
                              $count_active_customizes  = mysqli_num_rows($active_customizes_query);

                              //deactive customizes count from customizes table
                              $select_deactive_customizes = "SELECT * FROM customizes WHERE status='0'";
                              $deactive_customizes_query  = mysqli_query($connect,
                                                                           $select_deactive_customizes);
                              $count_deactive_customizes  = mysqli_num_rows($deactive_customizes_query);

                              ?>
                             


                              <div class="media p-1 rounded" style="background: #112230;">
                                <p class="mr-2 pt-2" style="background:#112233;"><i class="fas fa-user text-success" style="font-size:120px; height: 100px;"></i>
                                </p>
                                <div class="media-body">
                                  <div class="d-flex justify-content-between">
                                      <p><a href="../customizes/bg-color-list.php">All bg color</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_all_customizes; ?></b></p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../customizes/bg-color-list.php">Active bg color</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_active_customizes; ?></b></p>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                      <p><a href="../customizes/bg-color-list.php">Deactive bg color</a></p>
                                      <p><b class="badge badge-purple badge-pill"><?= $count_deactive_customizes; ?></b></p>
                                  </div>

                                </div>
                              </div>
                          </div>
                        </div>  
                        
                      </div>  <!-- row  -->
                    </div> <!-- container -->
                </div> <!-- content -->

<?php require "../../includes/layouts/footer.php"; ?>
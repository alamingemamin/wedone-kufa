<?php

session_start();
include "includes/database.php";

$select_site_icon = "SELECT * FROM  site_identy LIMIT 1";
$site_icon_query  = mysqli_query($connect,$select_site_icon);
$site_icon_row    = mysqli_fetch_assoc($site_icon_query);
 ?>



<!doctype html>
<html class="no-js" lang="en">

<!-- Mirrored from themebeyond.com/html/kufa/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Feb 2020 06:27:43 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?= ucwords($site_icon_row['title']); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" type="image/x-icon" href="uploads/site-icons/<?= $site_icon_row['icon']?>">
        <!-- Place favicon.ico in the root directory -->

		<!-- CSS here -->
        <link rel="stylesheet" href="frontend/css/bootstrap.min.css">
        <link rel="stylesheet" href="frontend/css/animate.min.css">
        <link rel="stylesheet" href="frontend/css/magnific-popup.css">
        <link rel="stylesheet" href="frontend/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="frontend/css/flaticon.css">
        <link rel="stylesheet" href="frontend/css/slick.css">
        <link rel="stylesheet" href="frontend/css/aos.css">
        <link rel="stylesheet" href="frontend/css/default.css">
        <link rel="stylesheet" href="frontend/css/style.css">
        <link rel="stylesheet" href="frontend/css/responsive.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


        <style type="text/css">

             body{
                overflow-x: hidden;
             }

             <?php 

              $select_bg_color = "SELECT * FROM customizes WHERE status='1' LIMIT 1";
              $bg_color_query  = mysqli_query($connect,$select_bg_color);
              $bg_color_row    = mysqli_fetch_assoc($bg_color_query);
             ?>

            .bg-theme{
                background: <?= $bg_color_row['bg_theme']; ?>;
            }

            .bg-header{
                background: <?= $bg_color_row['bg_header'];?>;
            }

            .bg-sidebar{
                 background: <?= $bg_color_row['bg_sidebar'];?>;
            }

            .bg-banner{
                background: <?= $bg_color_row['bg_banner'];?>;
            }

            .bg-about{
                background: <?= $bg_color_row['bg_about'];?>;
            }

            .bg-service{
                background: <?= $bg_color_row['bg_service'];?>;
            }

            .bg-portfolio{
                background: <?= $bg_color_row['bg_portfolio'];?>;
            }

            .bg-fact{
                background: <?= $bg_color_row['bg_fact'];?>;
            }

            .bg-testimonial{
                background: <?= $bg_color_row['bg_testimonial'];?>;
            }

            .bg-brand{
                background: <?= $bg_color_row['bg_brand'];?>;
            }

            .bg-contact{
                background: <?= $bg_color_row['bg_contact'];?>;
            }

            .bg-footer{
                background: <?= $bg_color_row['bg_footer'];?>;
            }
        </style>

    </head>
    <body class="bg-theme">

        <!-- preloader -->
        <div id="preloader">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="object" id="object_one"></div>
                    <div class="object" id="object_two"></div>
                    <div class="object" id="object_three"></div>
                </div>
            </div>
        </div>
        <!-- preloader-end -->

        <!-- header-start -->
        <header>
            <div id="header-sticky" class="transparent-header bg-header">
                <div class="container bg-header">
                    <div class="row bg-header">
                        <div class="col-xl-12 bg-header" >
                            <div class="main-menu">
                                <nav class="navbar navbar-expand-lg" >
                                    <?php 
                                     
                                     $logos_sql   = "SELECT * FROM logos WHERE deleted='0' AND status='1' LIMIT 1";
                                     $logos_query = mysqli_query($connect,$logos_sql);
                                     $logos_row   = mysqli_fetch_assoc($logos_query) ?>
                                        <a href="index.php" class="navbar-brand logo-sticky-none">
                                            <img src="<?= 'uploads/logos/'.$logos_row['logo']; ?>" alt="Medu" style="height: 30px;width: 60px;"></a>
                                        <a href="index.php" class="navbar-brand s-logo-none">
                                            <img src="<?= 'uploads/logos/'.$logos_row['logo']; ?>" alt="Logo" style="height: 30px;width: 60px;"></a>
                                   
                                    

                                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#navbarNav">
                                        <span class="navbar-icon"></span>
                                        <span class="navbar-icon"></span>
                                        <span class="navbar-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarNav">
                                        <ul class="navbar-nav ml-auto">
                                            <li class="nav-item active"><a class="nav-link" href="#home">Home</a></li>

                                            <li class="nav-item"><a class="nav-link" href="#about">about</a></li>

                                            <li class="nav-item"><a class="nav-link" href="#service">service</a></li>

                                            <li class="nav-item"><a class="nav-link" href="#portfolio">portfolio</a></li>

                                            <li class="nav-item"><a class="nav-link" href="blog-post.php">Blog</a></li>

                                            <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                                        </ul>
                                    </div>
                                    <div class="header-btn">
                                        <a href="#" class="off-canvas-menu menu-tigger"><i class="flaticon-menu"></i></a>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- offcanvas-start -->
            <?php 
                         $banner_select = "SELECT * FROM banners WHERE status='1' AND deleted='0' LIMIT 1";
                         $banner_query  = mysqli_query($connect,$banner_select);
                         $banner_row    = mysqli_fetch_assoc($banner_query);
                         $banner_id     = $banner_row['id'];
            ?>
            <div class="extra-info bg-sidebar">
                <div class="close-icon menu-close">
                    <button>
                        <i class="far fa-window-close"></i>
                    </button>
                </div>
                <div class="logo-side mb-30">
                    <a href="index.php" class="navbar-brand s-logo-none">
                      <img src="<?= 'uploads/logos/'.$logos_row['logo']; ?>" alt="Logo">
                  </a>
                </div>
                <div class="side-info mb-30">
                    <?php 
                         $contact_select = "SELECT * FROM contacts WHERE banner_id='$banner_id' AND status='1' AND deleted='0' LIMIT 1";
                         $contact_query  = mysqli_query($connect,$contact_select);
                         $contact_row = mysqli_fetch_assoc($contact_query);
                    ?>
                    <div class="contact-list mb-30">
                        <h4>Office Address</h4>
                        <p><?= $contact_row['address']; ?></p>
                    </div>

                    <div class="contact-list mb-30">
                        <h4>Phone</h4>
                        <p><?= $contact_row['phone']; ?></p>
                    </div>

                    <div class="contact-list mb-30">
                        <h4>Email Address</h4>
                        <p><?= $contact_row['email']; ?></p>
                    </div>
                    
                 
                   
                    
                </div>
                
            </div>
            <div class="offcanvas-overly"></div>
            <!-- offcanvas-end -->
        </header>
        <!-- header-end -->

        <!-- main-area -->
        <main>

            <!-- banner-area -->
            <section id="home" class="banner-area fix bg-banner">
                <div class="container">
                    

                    <div class="row align-items-center">
                       
                        <div class="col-xl-7 col-lg-6 mt-150">
                            <div class="banner-content">
                                <h6 class="wow fadeInUp" data-wow-delay="0.2s"><?= ucwords($banner_row['banner_greeting']); ?></h6>
                                <h2 class="wow fadeInUp" data-wow-delay="0.4s"><?= $banner_row['banner_title']; ?></h2>
                                <p class="wow fadeInUp" data-wow-delay="0.6s"><?= $banner_row['banner_description']; ?></p>
                                <div class="banner-social wow fadeInUp" data-wow-delay="0.8s">
                                    <?php 
                                    $select_banner_icon = "SELECT * FROM banner_icons WHERE banner_id='$banner_id'";
                                    $select_banner_icon_query = mysqli_query($connect,$select_banner_icon);

                                    ?>
                                    <ul>
                                        <?php  while ($banner_icon_row = mysqli_fetch_assoc($select_banner_icon_query)) { ?>
                                            <li><a href="<?= $banner_icon_row['banner_icon_link']; ?>"><i class="<?= $banner_icon_row['banner_icon_name']; ?>" style="color:<?= $banner_icon_row['banner_icon_color'] ?>;" ></i></a>
                                            </li>
                                        
                                       <?php }?>
                                        
                                    </ul>
                                </div>
                                <a href="#" class="btn wow fadeInUp" data-wow-delay="1s">SEE PORTFOLIOS</a>
                            </div>
                        </div>


                        <div class="col-xl-5 col-lg-6 d-none d-lg-block mt-120">
                            <div class="banner-img">
                                <img src="uploads/banners-photos/<?= $banner_row['banner_photo'];?>" alt="<?= $banner_row['banner_photo']?>" class="img-fluid">
                            </div>
                        </div>
                       

                    </div>

                </div>
                <!-- <div class="banner-shape"><img src="frontend/img/shape/dot_circle.png" class="rotateme" alt="img"></div> -->
            </section>
            <!-- banner-area-end -->

            <!-- about-area-->
            <section id="about" class="about-area pt-120 pb-120 bg-about">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="about-img">
                                <?php 
                                 
                                 $select_photo = "SELECT * FROM photos WHERE status='1' AND deleted='0' LIMIT 1";
                                 $select_photo_query = mysqli_query($connect,$select_photo);
                                 while ($select_photo_row = mysqli_fetch_assoc($select_photo_query)) { ?>
                                 <img src="uploads/photos/<?= $select_photo_row['photo'];?>" title="me-01" alt="me-01">
                                 <?php } ?>
                                
                            </div>
                        </div>
                        <div class="col-lg-6 pr-90">
                            <div class="section-title mb-25">
                                <span>Introduction</span>
                                <h2>About Me</h2>
                            </div>
                            <?php 

                            $select_about = "SELECT * FROM abouts WHERE banner_id='$banner_id' AND status='1' AND deleted='0' LIMIT 1";
                            $about_query  = mysqli_query($connect,$select_about);
                            $about_row    = mysqli_fetch_assoc($about_query);
                            ?>
                            <div class="about-content">
                                <p><?= $about_row['description']; ?></p>
                                <h3>Education:</h3>
                            </div>
                            <!-- Education Item -->
                            <?php 

                            $select_education = "SELECT * FROM educations WHERE banner_id='$banner_id' AND status='1' AND deleted='0'";
                            $education_query  = mysqli_query($connect,$select_education);
                            while ($education_row = mysqli_fetch_assoc($education_query)) {
                            ?>

                            <div class="education">
                                <div class="year"><?= $education_row['year']; ?></div>
                                <div class="line"></div>
                                <div class="location">
                                    <span><?= $education_row['name']; ?></span>
                                    <div class="progressWrapper">
                                        <div class="progress">
                                            <div class="progress-bar wow slideInLefts" data-wow-delay="0.2s" data-wow-duration="2s" role="progressbar" style="width:<?= $education_row['rank']; ?>%;" aria-valuenow="<?= $education_row['rank']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </section>
            <!-- about-area-end -->

            <!-- Services-area -->

            <?php 
             $service_select = "SELECT * FROM services WHERE status='1' AND deleted='0' LIMIT 6";
             $service_query  = mysqli_query($connect,$service_select);
             ?>
            <section id="service" class="services-area pt-120 pb-50 bg-service">
				<div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8">
                            <div class="section-title text-center mb-70">
                                <span>WHAT WE DO</span>
                                <h2>Services and Solutions</h2>
                            </div>
                        </div>
                    </div>
					<div class="row">
                      <?php while ($service_row = mysqli_fetch_assoc($service_query)): ?>
            
						<div class="col-lg-4 col-md-6">
							<div class="icon_box_01 wow fadeInLeft" data-wow-delay="0.2s">
                                <i class="<?= $service_row['service_icon']; ?>" style="color:<?= $service_row['service_icon_color']; ?>;"></i>
								<h3><?= $service_row['service_title'];?></h3>
								<p>
									<?= substr($service_row['service_description'],0,120) ?>
								</p>
							</div>
						</div>
                      <?php endwhile; ?>
					
					</div>
				</div>
			</section>
            <!-- Services-area-end -->

            <!-- Portfolios-area -->
            <section id="portfolio" class="portfolio-area pt-120 pb-90 bg-portfolio">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8">
                            <div class="section-title text-center mb-70">
                                <span>Portfolio Showcase</span>
                                <h2>My Recent Best Works</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <?php 
                          
                          $select_project = "SELECT * FROM projects WHERE status='1' AND deleted='0' LIMIT 6";
                          $project_query  = mysqli_query($connect,$select_project);
                          while ($project_row  = mysqli_fetch_assoc($project_query)) {
                          
                         ?>

                        <div class="col-lg-4 col-md-6 pitem">
                            <div class="speaker-box">
								<div class="speaker-thumb">
									<img src="uploads/projects-photos/<?= $project_row['project_photo']; ?>" alt="img" class="card-img card-fluid" style="min-width: 400px;height: 200px;">
								</div>
								<div class="speaker-overlay">
									<span><?= $project_row['project_title']; ?></span>
									<h4><a href="portfolio-single.php?name=<?= $project_row['project_name'];?>"><?= $project_row['project_name']; ?></a></h4>
									<a href="portfolio-single.php?name=<?= $project_row['project_name'];?>" class="arrow-btn">More information <span></span></a>
								</div>
							</div>
                        </div>

                       <?php } ?>


                    </div>
                </div>
            </section>
            <!-- portfolio-area-end -->


            <!-- fact-area -->

            <?php 
             $fact_select = "SELECT * FROM facts WHERE status='1' AND deleted='0' LIMIT 4";
             $fact_query  = mysqli_query($connect,$fact_select);
             ?>

            <section class="fact-area bg-fact">
                <div class="container">
                    <div class="fact-wrap">
                        <div class="row justify-content-between">
                            <?php while ($fact_row = mysqli_fetch_assoc($fact_query)): ?>
                           
                            <div class="col-xl-2 col-lg-3 col-sm-6">
                                <div class="fact-box text-center mb-50">
                                    <div class="fact-icon">
                                        <i class="<?= $fact_row['fact_icon']; ?>" style="color:<?= $fact_row['fact_icon_color']; ?>"></i>
                                    </div>
                                    <div class="fact-content">
                                        <h2>
                                            <?php 
                                              if ($fact_row['fact_count'] > 1000 && $fact_row['fact_count'] < 100000) {
                                                  echo '<span class="count">'.($fact_row['fact_count'] / 1000).'</span> K';

                                              }elseif ($fact_row['fact_count'] > 100000) {
                                                  echo '<span class="count">'.($fact_row['fact_count'] / 100000).'</span> M';

                                              }else{
                                                  echo '<span class="count">'.$fact_row['fact_count'].'</span>';
                                              }
                                            ?>
                                        </h2>
                                        <span><?= $fact_row['fact_title']; ?></span>
                                    </div>
                                </div>
                            </div>
                   
                             <?php endwhile;?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- fact-area-end -->

            <!-- testimonial-area -->
            <section class="testimonial-area pt-115 pb-115 bg-testimonial">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8">
                            <div class="section-title text-center mb-70">
                                <span>testimonial</span>
                                <h2>happy customer quotes</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10">
                            <div class="testimonial-active">
                                <?php 
                                 $select_client = "SELECT * FROM clients WHERE  status='1' AND deleted='0'";
                                 $client_query  = mysqli_query($connect,$select_client);
                                 while ($client_row = mysqli_fetch_assoc($client_query)) {
                                 
                                 ?>
                                <div class="single-testimonial text-center">
                                    <div class="testi-avatar">
                                        <img src="uploads/clients-photos/<?= $client_row['client_photo'] ?>" alt="img" class="rounded-circle" style="width: 100px;height: 100px;">
                                    </div>
                                    <div class="testi-content">
                                        <h4><span>“</span><?= $client_row['client_comments']; ?> <span>”</span></h4>
                                        <div class="testi-avatar-info">
                                            <h5><?= $client_row['client_name'];?></h5>
                                            <span><?= $client_row['client_occupation']; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- testimonial-area-end -->

            <!-- brand-area -->
            <div class="barnd-area pt-100 pb-100 bg-brand">
                <div class="container">
                    <div class="row brand-active justify-content-between">
                        <?php 

                        $brand_logo_sql   = "SELECT * FROM brands_logo WHERE deleted='0' AND status='1' LIMIT 5";
                        $brand_logo_query = mysqli_query($connect,$brand_logo_sql);
                        while ($brand_logo_row = mysqli_fetch_assoc($brand_logo_query)) { ?>
                        <div class="col-md-6">
                            <div class="single-brand">
                                <img src="uploads/brand-logos/<?= $brand_logo_row['brand_logo']; ?>" alt="img" style="width: 80px;height: 80px;">
                            </div>
                        </div>
                    

                        <?php } ?>
                        
                        
                        
                        
                        
                    </div>
                </div>
            </div>
            <!-- brand-area-end -->

            <!-- contact-area -->
            <section id="contact" class="contact-area  pt-120 pb-120 bg-contact">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="section-title mb-20">
                                <span>information</span>
                                <h2>Contact Information</h2>
                            </div>
                            <div class="contact-content">
                                <p>Event definition is - somthing that happens occurre How evesnt sentence. Synonym when an unknown printer took a galley.</p>
                                <h5>OFFICE IN <span><?= $contact_row['city']; ?></span></h5>
                                <div class="contact-list">
                                    <ul>
                                        <li><i class="fas fa-map-marker"></i><span>Address :</span><?= $contact_row['address']; ?></li>
                                        <li><i class="fas fa-headphones"></i><span>Phone :</span><?= $contact_row['phone']; ?></li>
                                        <li><i class="fas fa-globe-asia"></i><span>E-mail :</span><?= $contact_row['email']; ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <?php  if (isset($_SESSION['error'])): ?>


                                <script type="text/javascript">
                                  Swal.fire({
                                    icon: 'error',
                                    html:'<p><b class="text-danger"><i class="fa fa-warning"></i></b>&nbsp&nbsp&nbsp<span class="text-warning"><?php echo $_SESSION['error']; ?></span></p>',
                                  })
                                </script>

                            <?php endif; unset($_SESSION['error']); ?>
                            
                            <?php  if (isset($_SESSION['success'])): ?>


                                <script type="text/javascript">
                                  Swal.fire({
                                    icon: 'success',
                                    html:'<p><b class="text-success"><i class="fa fa-success"></i></b>&nbsp&nbsp&nbsp<span class="text-success"><?php echo $_SESSION['success']; ?></span></p>',
                                  })
                                </script>

                            <?php endif; unset($_SESSION['success']); ?>

                            <div class="contact-form">
                                <form action="frontend/guest-insert.php" method="post">
                                    <input type="text" placeholder="your name *" name="guest_name" value="<?php if(isset($_SESSION['guest_name'])){ echo $_SESSION['guest_name'];}?>">

                                    <input type="email" placeholder="your email *" name="guest_email" value="<?php if(isset($_SESSION['guest_email'])){ echo $_SESSION['guest_email'];}?>">

                                    <textarea name="guest_message" id="" placeholder="your message *"><?php if(isset($_SESSION['guest_message'])){ echo $_SESSION['guest_message'];}?></textarea>
                                    <button name="guest_btn" class="btn">SEND MESSAGE</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- contact-area-end -->

        </main>
        <!-- main-area-end -->

        <!-- footer -->
        <footer>
            <div class="copyright-wrap bg-footer">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="copyright-text text-center">
                                <p><?php echo date("Y"); ?> Copyright© <span><?= $site_icon_row['footer']; ?></span> | All Rights Reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer-end -->





		<!-- JS here -->
        <script src="frontend/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="frontend/js/popper.min.js"></script>
        <script src="frontend/js/bootstrap.min.js"></script>
        <script src="frontend/js/isotope.pkgd.min.js"></script>
        <script src="frontend/js/one-page-nav-min.js"></script>
        <script src="frontend/js/slick.min.js"></script>
        <script src="frontend/js/ajax-form.js"></script>
        <script src="frontend/js/wow.min.js"></script>
        <script src="frontend/js/aos.js"></script>
        <script src="frontend/js/jquery.waypoints.min.js"></script>
        <script src="frontend/js/jquery.counterup.min.js"></script>
        <script src="frontend/js/jquery.scrollUp.min.js"></script>
        <script src="frontend/js/imagesloaded.pkgd.min.js"></script>
        <script src="frontend/js/jquery.magnific-popup.min.js"></script>
        <script src="frontend/js/plugins.js"></script>
        <script src="frontend/js/main.js"></script>
    </body>

<!-- Mirrored from themebeyond.com/html/kufa/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Feb 2020 06:28:17 GMT -->
</html>

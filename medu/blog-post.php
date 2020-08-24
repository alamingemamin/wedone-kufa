<?php 

include "includes/database.php";

$select_site_icon = "SELECT * FROM  site_identy LIMIT 1";
$site_icon_query  = mysqli_query($connect,$select_site_icon);
$site_icon_row    = mysqli_fetch_assoc($site_icon_query);

?>


<!doctype html>
<html class="no-js" lang="en">

<!-- Mirrored from themebeyond.com/html/kufa/portfolio-single.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Feb 2020 06:29:11 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Blog post | <?= $site_icon_row['title']; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" type="image/x-icon" href="uploads/site-icons/<?= $site_icon_row['icon']; ?>">
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
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="main-menu">
                                <nav class="navbar navbar-expand-lg">

                               <?php 

                                     
                                     $logos_sql   = "SELECT * FROM logos WHERE deleted='0' AND status='1' LIMIT 1";
                                     $logos_query = mysqli_query($connect,$logos_sql);
                                    while ($logos_row = mysqli_fetch_assoc($logos_query)) { ?>
                                        <a href="index.php" class="navbar-brand logo-sticky-none">
                                            <img src="<?= 'uploads/logos/'.$logos_row['logo']; ?>" alt="Medu" style="height: 30px;width: 60px;"></a>
                                        <a href="index.php" class="navbar-brand s-logo-none">
                                            <img src="<?= 'uploads/logos/'.$logos_row['logo']; ?>" alt="Logo" style="height: 30px;width: 60px;"></a>
                                   <?php } ?>
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

                                            <li class="nav-item"><a class="nav-link" href="">Blog</a></li>

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
                         $banner_row  = mysqli_fetch_assoc($banner_query);
                         $banner_id     = $banner_row['id'];
            ?>
            <div class="extra-info bg-sidebar">
                <div class="close-icon menu-close">
                    <button>
                        <i class="far fa-window-close"></i>
                    </button>
                </div>
                <div class="logo-side mb-30">
                    <a href="index-2.html">
                        <img src="frontend/img/logo/logo.png" alt="" />
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

             <?php 


                $select_setting = "SELECT * FROM settings LIMIT 1";
                $select_query   = mysqli_query($connect,$select_setting);
                $setting_row    = mysqli_fetch_assoc($select_query);

              ?>

            <!-- blog-past-area -->
            <section class="portfolio-details-area pt-150 pb-120">
                <div class="container">
                    <?php
                    $record_per_page = $setting_row['limitation'];
                    $page            = 0;
                    $order           = $setting_row['sorting'];
                    $filter          = $setting_row['filtering']; 
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        
                    }else{
                        $page = 1;
                    }

                    $start_from = ($page - 1 )* $record_per_page;
                    $select_post = "SELECT * FROM posts WHERE status='1' AND deleted='0' ORDER BY $filter $order LIMIT $start_from,$record_per_page";
                    $post_query  = mysqli_query($connect,$select_post);
                    while ($post_row = mysqli_fetch_assoc($post_query)):
            
                    ?>
                     
                     <div class="row mb-2">
                        <div class="col-lg-5 col-sm-6">
                            <img src="uploads/post-photos/<?= $post_row['photo']; ?>" class="card-img rounded" style="min-height: 150px; max-height: 200px;">
                        </div>
                        <div class="col-lg-7 col-sm-6 p-1">
                            <h5><?= ucwords($post_row['title']); ?></h5>
                            <p>
                               <?= $post_row['body']; ?> 
                            </p>
                            <p><strong></strong></p>
                            <p class="muted"><small>
                             <?php $str = strtotime($post_row['created_at']);
                                echo date('jS F, Y h:i:s A',$str);
                             ?></small></p>
                        </div>
                    </div>
                    <hr>


                    <?php endwhile; ?>

                    <?php 

                    $page_query = "SELECT * FROM posts ORDER BY id DESC";
                    $page_result = mysqli_query($connect,$page_query);
                    $total_records = mysqli_num_rows($page_result);
                    $totaL_page = ceil($total_records/$record_per_page);
                    ?>

                    <ul class="pagination d-flex justify-content-center bg-dark">
                        <li class="page-item m-1"><a href="blog-post.php?page=1" class="page-link">First</a>
                        </li>
                    <?php    for($i = 2; $i <= $totaL_page; $i++){ ?>
                        <li class="page-item m-1"><a href="blog-post.php?page=<?= $i;?>" class="page-link"><?= $i;?></a></li>
                                   
                    <?php } ?>
                   </ul>
                </div>
            </section>
            <!-- blog post-area-end -->

        </main>
        <!-- main-area-end -->

        <!-- footer -->
        <footer>
            <div class="copyright-wrap bg-footer">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="copyright-text text-center">
                                <p>Copyright© <span><?= $site_icon_row['footer']; ?></span> | All Rights Reserved</p>
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

<!-- Mirrored from themebeyond.com/html/kufa/portfolio-single.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Feb 2020 06:29:14 GMT -->
</html>

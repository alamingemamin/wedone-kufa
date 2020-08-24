
<!doctype html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/Medu/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Apr 2019 06:51:24 GMT -->
<head>
        <meta charset="utf-8" />
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="../../assets/images/favicon.ico">

        <!-- App css -->
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="../../frontend/css/fontawesome-all.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="../../assets/js/modernizr.min.js"></script>


    </head>


    <body>

        <!-- Begin page -->
        <div id="wrapper" style="background: #111221;">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu" style="background: #111231;">

                <div class="slimscroll-menu" id="remove-scroll">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="index.html" class="logo">
                            <span>
                                <img src="../../assets/images/logo.png" alt="" height="22">
                            </span>
                            <i>
                                <img src="../../assets/images/logo_sm.png" alt="" height="28">
                            </i>
                        </a>
                    </div>

                    <!-- User box -->
                    <div class="user-box">
                        <div class="user-img">
                            <img src="../../uploads/users-photos/<?= $_SESSION['user_photo'];?>" alt="user-img" title="<?= $_SESSION['user_photo'];?>" class="rounded-circle img-fluid" style="width: 60px;height: 60px;">
                        </div>
                        <h5><a href="#" class="text-primary"><?php echo ucwords($_SESSION['user_name']); ?></a> </h5>
                        <p class="text-muted"><?php echo ($_SESSION['user_email']); ?></p>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu" style="background: #111211;">

                        <ul class="metismenu" id="side-menu">

                            <!--<li class="menu-title">Navigation</li>-->

                            <li class="text-pink">
                                <a href="../../dashboard/auth/index.php">
                                    <i class="fi-air-play"></i> <span> Dashboard </span>
                                </a>
                            </li>

                            <li class="text-primary">
                                <a href="javascript: void(0);"><i class="fi-layers"></i> <span> Users </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="../../dashboard/auth/all_users.php">Users List</a></li>
                                    <li><a href="../../dashboard/auth/user-trash.php">Trash User</a></li>
                                    <li><a href="../../dashboard/auth/change-password.php">Change Password</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-mail"></i><span> Posts </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="../../dashboard/posts/post-list.php">Posts list</a></li>
                                    <li><a href="../../dashboard/posts/trash-list.php">trash Posts list</a></li>
                                </ul>
                            </li>



                            <li>
                                <a href="javascript: void(0);"><i class="fi-mail"></i><span> Services </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="../../dashboard/services/service-list.php">Service list</a></li>
                                    <li><a href="../../dashboard/services/service-add.php">Add Service</a></li>
                                </ul>
                            </li>


                            <li>
                                <a href="javascript: void(0);"><i class="fi-command"></i><span> Facts </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="../../dashboard/facts/fact-list.php">Facts List</a></li>
                                    <li><a href="../../dashboard/facts/fact-add.php">Add Fact</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);"><i class="fi-box"></i><span> Banners </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="../../dashboard/banners/banner-list.php">Banners List</a></li>
                                    <li><a href="../../dashboard/banners/banner-add.php">Add Banner</a></li>
                                    
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-paper"></i> <span> Media </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="../../dashboard/guests/guest-list.php">Guests</a></li>
                                    <li><a href="../../dashboard/logos/logos-list.php">Logos</a></li>
                                    <li><a href="../../dashboard/brands-logos/brands-logos-list.php">Brand Logos</a></li>
                                    <li><a href="../../dashboard/photos/photo-list.php">Photos</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-location-2"></i> <span> Banner icons </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="../../dashboard/banner-icons/banner-icons-list.php">Banner icons list</a></li>
                                    <li><a href="../../dashboard/banner-icons/banner-icons-add.php">Banner icons add</a></li>
                                    
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-paper-stack"></i><span> Projects</span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="../../dashboard/projects/project-list.php">Project list</a></li>
                                    <li><a href="../../dashboard/projects/project-add.php">Add Project</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-paper-stack"></i><span> Informations</span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="../../dashboard/abouts/about-list.php">Abouts</a></li>
                                    <li><a href="../../dashboard/educations/education-list.php">Educations</a></li>
                                    <li><a href="../../dashboard/contacts/contact-list.php">Contacts</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-paper-stack"></i><span> Testimonials</span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="../../dashboard/clients/client-list.php">Clients list</a></li>
                                    <li><a href="../../dashboard/clients/client-add.php">Clients add</a></li>
                                    
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-paper-stack"></i><span> Site Identfication</span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="../../dashboard/site-identify/site-identify-list.php">Site identy list</a></li>
                                    
                                </ul>
                            </li>
                        </ul>

                    </div>
                    <!-- Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->

            <div class="content-page">

                <!-- Top Bar Start -->
                <div class="topbar">

                    <nav class="navbar-custom">

                        <ul class="list-unstyled topbar-right-menu float-right mb-0">

                            <li class="hide-phone app-search">
                                <form action="../../dashboard/auth/search-result.php" method="post">
                                    <input type="text" placeholder="Search..." class="form-control" name="search-text">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </li>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <i class="fi-bell noti-icon"></i>
                                    <span class="badge badge-danger badge-pill noti-icon-badge">4</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">


                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5 class="m-0"><span class="float-right"><a href="#" class="text-dark"><small>Clear All</small></a> </span>Notification</h5>
                                    </div>

                                    <div class="slimscroll" style="max-height: 230px;">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-success"><i class="mdi mdi-comment-account-outline"></i></div>
                                            <p class="notify-details">Caleb Flakelar commented on Admin<small class="text-muted">1 min ago</small></p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-info"><i class="mdi mdi-account-plus"></i></div>
                                            <p class="notify-details">New user registered.<small class="text-muted">5 hours ago</small></p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-danger"><i class="mdi mdi-heart"></i></div>
                                            <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">3 days ago</small></p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-warning"><i class="mdi mdi-comment-account-outline"></i></div>
                                            <p class="notify-details">Caleb Flakelar commented on Admin<small class="text-muted">4 days ago</small></p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-purple"><i class="mdi mdi-account-plus"></i></div>
                                            <p class="notify-details">New user registered.<small class="text-muted">7 days ago</small></p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-custom"><i class="mdi mdi-heart"></i></div>
                                            <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">13 days ago</small></p>
                                        </a>
                                    </div>

                                    <!-- All-->
                                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                        View all <i class="fi-arrow-right"></i>
                                    </a>

                                </div>
                            </li>

                            <?php 
                            
                             $databse = mysqli_connect("localhost","root","","medu");
                             $guest_count_sql   = "SELECT * FROM guests WHERE status='0'";
                             $guest_count_query = mysqli_query($databse,$guest_count_sql);
                             $guest_unread_count = mysqli_num_rows($guest_count_query);
                             ?>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <i class="fi-speech-bubble noti-icon"></i>
                                    <span class="badge badge-custom badge-pill noti-icon-badge"><?= $guest_unread_count; ?></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">


                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5 class="m-0"><span class="float-right"><a href="#" class="text-dark"><small>Clear All</small></a> </span>Chat</h5>
                                    </div>

                                    <div class="slimscroll" style="max-height: 230px;">
                                        <!-- item-->
                                         <?php while ($guest_count_row = mysqli_fetch_assoc($guest_count_query)) { ?>

                                          <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon"> </div>
                                            <p class="notify-details text-pink"><?= $guest_count_row['guest_name'] ?></p>
                                            <p class="text-muted font-13 mb-0 user-msg">
                                                <?= substr($guest_count_row['guest_message'],0,20); ?>
                                            </p>
                                        </a>
                                             
                                        <?php }?>

                                     
                                     
                                    </div>

                                    <!-- All-->
                                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                        View all <i class="fi-arrow-right"></i>
                                    </a>

                                </div>
                            </li>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="../../uploads/users-photos/<?= $_SESSION['user_photo'];?>" alt="user" class="rounded-circle"> <span class="ml-1">
                                        <b>
                                            <?php 

                                              if ($_SESSION['user_role'] == 1) {
                                                  echo "Admin";
                                              }elseif ($_SESSION['user_role'] == 2) {
                                                  echo "Moderator";
                                              }elseif ($_SESSION['user_role'] == 3) {
                                                  echo "Editor";
                                              }else{
                                                  echo "Normal";
                                              }

                                            ?>
                                            
                                        </b><i class="mdi mdi-chevron-down"></i> </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h6 class="text-overflow m-0">Welcome !</h6>
                                    </div>

                                    <!-- item-->
                                    <a href="../../dashboard/auth/my-account.php" class="dropdown-item notify-item">
                                        <i class="fi-head"></i> <span>My Account</span>
                                    </a>

                                    <!-- item-->
                                    <a href="../../dashboard/settings/setting.php" class="dropdown-item notify-item">
                                        <i class="fi-cog"></i> <span>Settings</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fi-help"></i> <span>Support</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fi-lock"></i> <span>Lock Screen</span>
                                    </a>

                                    <!-- item-->
                                    <a href="../../dashboard/logout.php" class="dropdown-item notify-item">
                                        <i class="fi-power"></i> <span>Logout</span>
                                    </a>

                                </div>
                            </li>

                        </ul>

                        <ul class="list-inline menu-left mb-0">
                            <li class="float-left">
                                <button class="button-menu-mobile open-left disable-btn">
                                    <i class="dripicons-menu"></i>
                                </button>
                            </li>
                            <li>
                                <div class="page-title-box">
                                    <h4 class="page-title">Dashboard </h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active">Welcome to MEdu panel !</li>
                                    </ol>
                                </div>
                            </li>

                        </ul>

                    </nav>

                </div>
                <!-- Top Bar End -->


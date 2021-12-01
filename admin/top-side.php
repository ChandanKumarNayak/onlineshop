<?php include $_SERVER['DOCUMENT_ROOT']."/constant.inc.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/db.inc.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/function.inc.php"; ?>

<?php 
session_start();
if (!isset($_SESSION['ADMIN_ID'])) {
    redirect(ADMIN_LANDING_PATH.'login');
}
?>

<?php

$page_title = "";

$product_menu_open = "";
$product_cat_active = "";
$prod_sub_cat_active = "";
$brand_active = "";

$customer_menu_open = "";

$staff_menu_open = "";


$curStr = $_SERVER['REQUEST_URI'];
$curArr = explode('/', $curStr);
$curPath = $curArr[count($curArr) - 1];

if($curPath == '' || $curPath == 'index') {
  $page_title = "Dashboard";
} elseif($curPath == 'product_cat') {
  $page_title = "Product Category";
  $product_menu_open = "menu-open";
  $product_cat_active = "active";
} elseif($curPath == 'prod_sub_cat') {
  $page_title = "Product Sub-Category";
  $product_menu_open = "menu-open";
  $prod_sub_cat_active = "active";
} elseif($curPath == 'brand') {
    $page_title = "Product Brands";
    $product_menu_open = "menu-open";
    $brand_active = "active";
} else {
  $page_title = "";
}

?>



<html lang="en-IN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $page_title .' | '. SITE_NAME; ?></title>
    <link rel="icon" href="<?php echo ADMIN_IMAGE_PATH ?>icon.jpg" /> <!-- page icon -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo ADMIN_LANDING_PATH ?>plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?php echo ADMIN_LANDING_PATH ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo ADMIN_LANDING_PATH ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo ADMIN_LANDING_PATH ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo ADMIN_LANDING_PATH ?>assets/css/adminlte.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo ADMIN_LANDING_PATH ?>plugins/daterangepicker/daterangepicker.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="<?php echo ADMIN_LANDING_PATH ?>assets/css/custom.css">
    <!-- Chosen js drop down css -->
    <link rel="stylesheet" href="<?php echo ADMIN_LANDING_PATH ?>assets/css/chosen.min.css" />
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="<?php echo ADMIN_IMAGE_PATH ?>icon.jpg" alt="logo" height="60"
                width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="javascript:void(0)" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo ADMIN_LANDING_PATH ?>logout" role="button">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo ADMIN_LANDING_PATH ?>" class="brand-link">
                <img src="<?php echo ADMIN_IMAGE_PATH ?>icon.jpg" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Shop</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <?php
          $session_id = "";
            $session_id = $_SESSION['ADMIN_ID'];
            $sql_fetch = "SELECT * FROM `admin` WHERE id = '$session_id' ";
            $execInfo = mysqli_query($db,$sql_fetch);
            if(mysqli_num_rows($execInfo) == 1)
              while($row_fetch = mysqli_fetch_assoc($execInfo)) { ?>
                    <div class="image">
                        <img src="<?php echo ADMIN_IMAGE_PATH ?><?php echo get_safe_value($row_fetch['avatar']) ?>"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="javascript:void(0)"
                            class="d-block"><?php echo get_safe_value($row_fetch['first_name']); echo ' '; echo get_safe_value($row_fetch['last_name']); ?></a>
                    </div>
                    <?php }  ?>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item <?php echo $product_menu_open ?>">
                            <a href="javascript:void(0)" class="nav-link">
                                <i class="nav-icon fas fa-shopping-basket"></i>
                                <p>
                                    Product
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo ADMIN_LANDING_PATH ?>prod-cat/product_cat" class="nav-link <?php echo $product_cat_active ?>">
                                        <i class="far fa-dot nav-icon"></i>
                                        <p>Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo ADMIN_LANDING_PATH ?>prod-sub-cat/prod_sub_cat" class="nav-link <?php echo $prod_sub_cat_active ?>">
                                        <i class="far fa-dot nav-icon"></i>
                                        <p>Sub-Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo ADMIN_LANDING_PATH ?>brand/brand" class="nav-link <?php echo $brand_active ?>">
                                        <i class="far fa-dot nav-icon"></i>
                                        <p>Brands</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo ADMIN_LANDING_PATH ?>" class="nav-link">
                                        <i class="far fa-dot nav-icon"></i>
                                        <p>Pack Size</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo ADMIN_LANDING_PATH ?>" class="nav-link">
                                        <i class="far fa-dot nav-icon"></i>
                                        <p>All Products</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo ADMIN_LANDING_PATH ?>" class="nav-link">
                                        <i class="far fa-dot nav-icon"></i>
                                        <p>Discount & Offers</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item <?php echo $customer_menu_open ?>">
                            <a href="javascript:void(0)" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Customer
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo ADMIN_LANDING_PATH ?>pages/layout/top-nav" class="nav-link">
                                        <i class="far fa-dot nav-icon"></i>
                                        <p>Customer List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item <?php echo $staff_menu_open ?>">
                            <a href="javascript:void(0)" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Staff Member
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo ADMIN_LANDING_PATH ?>pages/charts/chartjs" class="nav-link">
                                        <i class="far fa-dot nav-icon"></i>
                                        <p>Delivery Boy</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
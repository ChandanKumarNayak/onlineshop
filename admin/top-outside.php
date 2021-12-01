<?php include "../constant.inc.php"; ?>
<?php include "../db.inc.php"; ?>
<?php include "../function.inc.php"; ?>
<?php

$curStr = $_SERVER['REQUEST_URI'];
$curArr = explode('/', $curStr);
$curPath = $curArr[count($curArr) - 1];

$page_title = "";
if ($curPath == '' || $curPath == 'login') {
  $page_title = "Login";
}

?>


<html lang="en-IN">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $page_title .' | '. SITE_NAME; ?></title>
  <link rel="icon" href="<?php echo ADMIN_IMAGE_PATH ?>icon.jpg" /> <!-- page icon -->
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo ADMIN_LANDING_PATH ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo ADMIN_LANDING_PATH ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo ADMIN_LANDING_PATH ?>assets/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
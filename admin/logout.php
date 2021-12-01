<?php include "../constant.inc.php"; ?>
<?php include "../db.inc.php"; ?>
<?php include "../function.inc.php"; ?>

<?php
session_start();
unset($_SESSION['ADMIN_ID']);
session_destroy();
redirect(ADMIN_LANDING_PATH.'login');
?>
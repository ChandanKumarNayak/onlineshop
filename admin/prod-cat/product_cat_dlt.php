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
    $cat_img_fetch = "";
    if(isset($_POST['cat_id']) && $_POST['cat_id'] != 0 && isset($_POST['type']) && $_POST['type'] != ''){
    $cat_id = get_safe_value($_POST['cat_id']);    
    $type = get_safe_value($_POST['type']);

    $check_cat_img = "SELECT cat_img FROM product_cat WHERE cat_id = '$cat_id' ";
    $qresult=mysqli_query($db, $check_cat_img);
    while ($row = mysqli_fetch_assoc($qresult)) {
        $cat_img_fetch = get_safe_value($row['cat_img']);
    }

    if($type == 'cat_dlt'){
 
        $sql_dlt_cat = "DELETE FROM product_cat WHERE cat_id ='$cat_id' ";
        if(mysqli_query($db, $sql_dlt_cat)){
            unlink('images/'.$cat_img_fetch);
            echo 1;
        } else {
            echo 0; 
        }

    }
    }
?>
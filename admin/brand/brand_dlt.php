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
    $sub_cat_img_fetch = "";
    if(isset($_POST['sub_cat_id']) && $_POST['sub_cat_id'] != 0 && isset($_POST['type']) && $_POST['type'] != ''){
    $sub_cat_id = get_safe_value($_POST['sub_cat_id']);    
    $type = get_safe_value($_POST['type']);

    $check_sub_cat_img = "SELECT sub_cat_img FROM prod_sub_cat WHERE sub_cat_id = '$sub_cat_id' ";
    $qresult=mysqli_query($db, $check_sub_cat_img);
    while ($row = mysqli_fetch_assoc($qresult)) {
        $sub_cat_img_fetch = get_safe_value($row['sub_cat_img']);
    }

    if($type == 'sub_cat_dlt'){
 
        $sql_dlt_sub_cat = "DELETE FROM prod_sub_cat WHERE sub_cat_id ='$sub_cat_id' ";
        if(mysqli_query($db, $sql_dlt_sub_cat)){
            unlink('images/'.$sub_cat_img_fetch);
            echo 1;
        } else {
            echo 0; 
        }

    }
    }
?>